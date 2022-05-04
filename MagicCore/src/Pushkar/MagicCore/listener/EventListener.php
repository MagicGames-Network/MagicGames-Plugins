<?php

namespace Pushkar\MagicCore\listener;

use pocketmine\Server;
use pocketmine\world\World;
use Pushkar\MagicCore\Main;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\item\ItemFactory;
use onebone\economyapi\EconomyAPI;
use pocketmine\math\VoxelRayTrace;
use pocketmine\block\BlockLegacyIds;
use Pushkar\MagicCore\forms\StarForm;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;
use Pushkar\MagicCore\forms\CraftingTableForm;
use pocketmine\event\player\PlayerInteractEvent;
use Pushkar\MagicCore\forms\anvil\AnvilMainForm;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;

class EventListener implements Listener
{
    public function onJoin(PlayerJoinEvent $event): void
    {
        $sender = $event->getPlayer();
        //$event->setJoinMessage(str_replace(["{name}"], [$sender->getName()], Main::getInstance()->getConfig()->get("join-message")));
        $item = ItemFactory::getInstance()->get(1070, 0, 1);
        $item->setCustomName("§r§aSkyblock Menu §7( Right Click )§r");
        $item->setLore(["§r§7View All Of Your Skyblock Progress Including Your Skills,\n§7Collections, Recipes And More!\n\n§r§eClick To Open!"]);
        $sender->getHungerManager()->setFood(20);
        $sender->getHungerManager()->setSaturation(20);
        $sender->getInventory()->setItem(8, $item);
        if ($sender->isConnected()) {
            $name = $sender->getName();
            $sender->sendMessage("§e==============§6=============\n§r§7Welcome, $name §7to §eMagic Skyblock\n\n§7Amazing SkyBlock Experience On Bedrock\n\n§e§lVOTE: §r§7Our Vote Website http://bit.ly/vote-magic \n§6§lDISCORD: §r§7http://discord.io/magicgames\n§e==============§6==============");
            if (Main::getInstance()->getConfig()->get("Hub-Spawn") === true) {
                $defaultWorld = Main::getInstance()->getServer()->getWorldManager()->getDefaultWorld();
                if (!$defaultWorld instanceof World) {
                    return;
                }

                $sender->teleport($defaultWorld->getSafeSpawn());
            }
            if (Main::getInstance()->getConfig()->get("onJoin-FlyReset") === true) {
                if ($sender->isCreative()) return;
                $sender->setAllowFlight(false);
            }
        }
        $ainv = $sender->getArmorInventory();
        if (!$sender->hasPlayedBefore()) {
            if (Main::getInstance()->getConfig()->get("First-Join") === true) {
                if (Main::getInstance()->getConfig()->get("Inventory") === true) {
                    foreach (Main::getInstance()->getConfig()->get("Slots", []) as $slotItem) {
                        $result = ItemFactory::getInstance()->get($slotItem["id"], $slotItem["damage"], $slotItem["count"]);
                        $result->setCustomName($slotItem["name"]);
                        $result->setLore([$slotItem["lore"]]);
                        $sender->getInventory()->setItem($slotItem["slot"], $result);
                    }
                }
                foreach (Main::getInstance()->getConfig()->get("First-Join-Command") as $v) {
                    Main::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(Main::getInstance()->getServer(), Main::getInstance()->getServer()->getLanguage()), str_replace("{player}", $sender->getName(), $v));
                }
                if (Main::getInstance()->getConfig()->get("Armor") === true) {
                    $data = Main::getInstance()->getConfig()->get("helm");
                    $item = ItemFactory::getInstance()->get($data["id"]);
                    $item->setCustomName($data["name"]);
                    $item->setLore([$data["lore"]]);
                    $ainv->setHelmet($item);

                    $data = Main::getInstance()->getConfig()->get("chest");
                    $item = ItemFactory::getInstance()->get($data["id"]);
                    $item->setCustomName($data["name"]);
                    $item->setLore([$data["lore"]]);
                    $ainv->setChestplate($item);

                    $data = Main::getInstance()->getConfig()->get("leggins");
                    $item = ItemFactory::getInstance()->get($data["id"]);
                    $item->setCustomName($data["name"]);
                    $item->setLore([$data["lore"]]);
                    $ainv->setLeggings($item);

                    $data = Main::getInstance()->getConfig()->get("boots");
                    $item = ItemFactory::getInstance()->get($data["id"]);
                    $item->setCustomName($data["name"]);
                    $item->setLore([$data["lore"]]);
                    $ainv->setBoots($item);
                }
            }
        }
    }

    /**
     * @handleCancelled
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        $sender = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();
        switch ($event->getAction()) {
            case PlayerInteractEvent::LEFT_CLICK_BLOCK:
                if ($item->getId() === 1070 && $item->getCustomName() === "§r§aSkyblock Menu §7( Right Click )§r") {
                    $event->cancel();
                    $sender->sendForm(new StarForm());;
                }
                break;
            case PlayerInteractEvent::RIGHT_CLICK_BLOCK:
                if ($item->getId() === 1070 && $item->getCustomName() === "§r§aSkyblock Menu §7( Right Click )§r") {
                    $event->cancel();
                    $sender->sendForm(new StarForm());
                }
                if (Main::getInstance()->getConfig()->get("Anvil-Ui") === true) {
                    if ($block->getId() == 145) {
                        $event->cancel();
                        $event->getPlayer()->sendForm(new AnvilMainForm());
                    }
                }
                if (Main::getInstance()->getConfig()->get("CraftingTable-Ui") === true) {
                    if ($block->getId() == 58) {
                        $event->cancel();
                        $sender->sendForm(new CraftingTableForm());
                    }
                }
                if ($item->getNamedTag()->getTag("aspect_of_the_end") !== null) {
                    $start = $sender->getPosition()->add(0, $sender->getEyeHeight(), 0);

                    $endVector = $sender->getDirectionVector()->multiply($sender->getViewDistance() * 16);
                    $end = $start->add($endVector->getX(), $endVector->getY(), $endVector->getZ());
                    $level = $sender->getWorld();
                    foreach (VoxelRayTrace::betweenPoints($start, $end) as $vector3) {
                        if ($vector3->y >= World::Y_MAX or $vector3->y <= 0) {
                            return;
                        }
                        if (($result = $level->getBlockAt((int)$vector3->x, (int)$vector3->y, (int)$vector3->z)->calculateIntercept($start, $end)) !== null) {
                            $target = $result->hitVector;
                            $sender->teleport($target);
                            return;
                        }
                    }
                }
                // uhhh i dont think we should really do that ~ AGTHARN

                //if ($item->getNamedTag()->getTag("golem_sword") !== null) {
                //    $explosion = new Explosion(new Position($block->getPosition()->getX(), $block->getPosition()->getY(), $block->getPosition()->getZ(), $sender->getPosition()->getWorld()), 1, null);
                //    $explosion->explodeB();
                //}
                if ($item->getNamedTag()->getTag("leaping_sword") !== null) {
                    $sender->setMotion(new Vector3(mt_rand(1, 3), mt_rand(1, 3), mt_rand(1, 3)));
                }
                if ($item->getNamedTag()->getTag("profile") !== null) {
                    Server::getInstance()->dispatchCommand($sender, "profile");
                }
                if ($item->getNamedTag()->getTag("bag") !== null) {
                    #soon
                }
                if ($item->getNamedTag()->getTag("bank") !== null) {
                    Server::getInstance()->dispatchCommand($sender, "bank");
                }
                break;
        }
    }

    public function onTransaction(InventoryTransactionEvent $event): void
    {
        $transaction = $event->getTransaction();
        foreach ($transaction->getActions() as $action) {
            $item = $action->getSourceItem();
            if ($item->getId() === 1070 && $item->getCustomName() === "§r§aSkyblock Menu §7( Right Click )§r") {
                $event->cancel();
            }
        }
    }

    public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if (!$entity instanceof Player) {
            return;
        }

        if (Main::getInstance()->getConfig()->get("onDamage-FlyReset") === true) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    if ($damager->isCreative()) return;
                    if ($damager->getAllowFlight() === true) {
                        $damager->sendMessage(Main::PREFIX . "Flight mode disabled due to combat");
                        $damager->setAllowFlight(false);
                        $damager->setFlying(false);
                    }
                }
            }
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_VOID) {
            $defaultWorld = $entity->getWorld()->getSpawnLocation();
            $senderMoney = EconomyAPI::getInstance()->myMoney($entity);
            if (!is_float($senderMoney)) {
                return;
            }

            $entity->teleport($defaultWorld);
            $event->cancel();
            if (Main::getInstance()->getConfig()->get("Void-Money-Lose") === true) {
                switch (Main::getInstance()->getConfig()->get("Type")) {
                    case "all":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($entity, $senderMoney);
                        break;
                    case "half":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . $senderMoney / 2);
                        EconomyAPI::getInstance()->reduceMoney($entity, $senderMoney / 2);
                        break;
                    case "amount":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                        EconomyAPI::getInstance()->reduceMoney($entity, (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                        break;
                    case "percent":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($entity, ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                        break;
                }
            }
        }
    }

    public function onBreak(BlockBreakEvent $event): void
    {
        #Nothing lol
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        $sender = $event->getPlayer();
        if (Main::getInstance()->getConfig()->get("KeepInventory") == true) {
            $worldName = $event->getPlayer()->getWorld()->getDisplayName();
            $worlds = Main::getInstance()->getConfig()->get("KeepInventory-Worlds");
            switch (Main::getInstance()->getConfig()->get("KeepInventory-Mode")) {
                case "all":
                    $event->setKeepInventory(true);
                    break;
                case "whitelist":
                    if (in_array($worldName, $worlds)) {
                        $event->setKeepInventory(true);
                    }
                    break;
                case "blacklist":
                    if (!in_array($worldName, $worlds)) {
                        $event->setKeepInventory(true);
                    }
                    break;
            }
        } else {
            $event->setKeepInventory(false);
        }

        $lastDamage = $sender->getLastDamageCause();
        if (!$lastDamage instanceof EntityDamageByEntityEvent) return;

        $senderMoney = EconomyAPI::getInstance()->myMoney($sender);
        if (is_bool($senderMoney)) {
            return;
        }

        $damager = $lastDamage->getDamager();
        if (Main::getInstance()->getConfig()->get("Death-Money-Lose") === true) {
            if (!$damager instanceof Player) {
                Main::getInstance()->naturalMoneyLoss($sender, $senderMoney);
                return;
            }
            switch (Main::getInstance()->getConfig()->get("Type")) {
                case "all":
                    if (Main::getInstance()->getConfig()->get("KillerGainMoney")) {
                        $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . $senderMoney);
                        EconomyAPI::getInstance()->addMoney($damager, $senderMoney);
                    }
                    $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney);
                    EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney);
                    break;
                case "half":
                    if (Main::getInstance()->getConfig()->get("KillerGainMoney")) {
                        $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . $senderMoney / 2);
                        EconomyAPI::getInstance()->addMoney($damager, $senderMoney / 2);
                    }
                    $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney / 2);
                    EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney / 2);
                    break;
                case "amount":
                    if (Main::getInstance()->getConfig()->get("KillerGainMoney")) {
                        $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                        EconomyAPI::getInstance()->addMoney($damager, (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                    }
                    $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                    EconomyAPI::getInstance()->reduceMoney($sender, (float)Main::getInstance()->getConfig()->get("Money-Loss"));
                    break;
                case "percent":
                    if (Main::getInstance()->getConfig()->get("KillerGainMoney")) {
                        $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                        EconomyAPI::getInstance()->addMoney($damager, ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                    }
                    $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                    EconomyAPI::getInstance()->reduceMoney($sender, ((float)Main::getInstance()->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                    break;
            }
        }
    }

    public function onPlayerTrample(EntityTrampleFarmlandEvent $event): void
    {
        $event->cancel();
    }

    /*public function onMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $player->getWorld()->getBlock($player->getPosition());
        if ($block->getId() == BlockLegacyIds::END_PORTAL) {
            Server::getInstance()->dispatchCommand($player, "join");
        }
        if ($block->getId() == BlockLegacyIds::PORTAL) {
            Server::getInstance()->dispatchCommand($player, "hub");
        }
    }*/

    public function onPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();
        if ($item->getNamedTag()->getTag("enchantedblock") !== null) {
            $event->cancel();
            $player->sendMessage(" §eYou Can't Place Enchanted Blocks On Ground");
        }
    }
}
