<?php

namespace Pushkar\MagicCore\listener\type;

use pocketmine\Server;
use pocketmine\world\World;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use _64FF00\PurePerms\PurePerms;
use AGTHARN\MagicSync\MagicSync;
use pocketmine\item\ItemFactory;
use Pushkar\MagicCore\MagicCore;
use onebone\economyapi\EconomyAPI;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\VoxelRayTrace;
use pocketmine\scheduler\ClosureTask;
use Pushkar\MagicCore\forms\StarForm;
use Pushkar\MagicCore\utils\Configuration;
use Pushkar\MagicCore\forms\GrindStoneForm;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use Pushkar\MagicCore\forms\anvil\AnvilMainForm;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use Pushkar\MagicCore\utils\Utils;

class PlayerListener implements Listener
{
    public function onJoin(PlayerJoinEvent $event): void
    {
        MagicSync::getInstance()->addPlayerJoin($event->getPlayer(), new ClosureTask(function () use ($event): void {
            $player = $event->getPlayer();
            $playerName = $player->getName();
            if (!file_exists(MagicCore::getInstance()->getDataFolder() . "Players/$playerName.yml")) {
                new Config(MagicCore::getInstance()->getDataFolder() . "Players/$playerName.yml", Config::YAML, array(
                    "Bits" => 0,
                    "Claimed" => [],
                    "PremiumPass" => false,
                    "PremiumClaimed" => [],
                ));
            }
            /** @var PurePerms */
            $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
            $item = ItemFactory::getInstance()->get(1070, 0, 1);

            MagicCore::getInstance()->loadData($player);
            Utils::updateScoreHud($player, MagicCore::getInstance()->getBitsBalance($player->getName()));
            $event->setJoinMessage("");

            $item->setCustomName("§r§aSkyblock Menu §7( Right Click )§r");
            $item->setLore(["§r§7View All Of Your Skyblock Progress Including Your Skills,\n§7Collections, Recipes And More!\n\n§r§eClick To Open!"]);
            $player->getHungerManager()->setFood(20);
            $player->getHungerManager()->setSaturation(20);
            $player->getInventory()->setItem(8, $item);

            match ($purePerms->getUserDataMgr()->getData($player)["group"]) {
                "LORD" => Server::getInstance()->broadcastMessage(" §r§l§d[LORD]§r§e $playerName §bHas Joined The Game"),
                "LORDPLUS" => Server::getInstance()->broadcastMessage(" §r§l§d[LORD§b+§d]§r§e $playerName §bHas Joined The Game"),
                "YouTube" => Server::getInstance()->broadcastMessage(" §r§l§c[§fYOUTUBE§c]§r§c $playerName §bHas Joined The Game"),
                default => null
            };
            $player->sendMessage("§e==============§6=============\n§r§7Welcome, $playerName §7to §eMagic Skyblock\n\n§7Amazing SkyBlock Experience On Bedrock\n\n§e§lVOTE: §r§7Our Vote Website http://bit.ly/vote-magic \n§6§lDISCORD: §r§7http://discord.io/magicgames\n§e==============§6==============");

            if (Configuration::$joinTeleport) {
                $defaultWorld = MagicCore::getInstance()->getServer()->getWorldManager()->getDefaultWorld();
                if ($defaultWorld instanceof World) {
                    $player->teleport($defaultWorld->getSafeSpawn());
                }
            }
            if (Configuration::$joinDisableFlight) {
                if (!$player->isCreative()) {
                    $player->setAllowFlight(false);
                }
            }

            $armorInventory = $player->getArmorInventory();
            if (!$player->hasPlayedBefore()) {
                if (Configuration::$firstJoinItems) {
                    foreach (Configuration::$joinItemList as $itemData) {
                        $item = ItemFactory::getInstance()->get($itemData["id"], $itemData["meta"], $itemData["count"]);
                        $item->setCustomName($itemData["name"]);
                        $item->setLore([$itemData["lore"]]);
                        $player->getInventory()->setItem($itemData["slot"], $item);
                    }
                }

                if (Configuration::$firstJoinCommands) {
                    foreach (Configuration::$joinCommandsList as $cmd) {
                        MagicCore::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(MagicCore::getInstance()->getServer(), MagicCore::getInstance()->getServer()->getLanguage()), str_replace("{player}", $player->getName(), $cmd));
                    }
                }

                if (Configuration::$firstJoinArmor) {
                    foreach (Configuration::$joinArmorList as $itemData) {
                        $item = ItemFactory::getInstance()->get($itemData["id"], 0, 1);

                        $item->setCustomName($itemData["name"]);
                        $item->setLore([$itemData["lore"]]);
                        match ($itemData["type"]) {
                            "helmet" => $armorInventory->setHelmet($item),
                            "chestplate" => $armorInventory->setChestplate($item),
                            "leggings" => $armorInventory->setLeggings($item),
                            "boots" => $armorInventory->setBoots($item),
                            default => null
                        };
                    }
                }
            }
        }), "RUNNING CORE CHECKS");
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        MagicCore::getInstance()->saveData($player);
        unset(MagicCore::getInstance()->bitsMoney[$player->getName()]);
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
                    $sender->sendForm(new StarForm($sender));
                }
                break;
            case PlayerInteractEvent::RIGHT_CLICK_BLOCK:
                if ($item->getId() === 1070 && $item->getCustomName() === "§r§aSkyblock Menu §7( Right Click )§r") {
                    $event->cancel();
                    $sender->sendForm(new StarForm($sender));
                }
                if (Configuration::$anvilUI) {
                    if ($block->getId() == 145) {
                        $event->cancel();
                        $event->getPlayer()->sendForm(new AnvilMainForm());
                    }
                }
                if (Configuration::$grindStoneUI) {
                    if ($block->getId() == 450) {
                        $event->cancel();
                        $sender->sendForm(new GrindStoneForm());
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

                if ($item->getNamedTag()->getTag("leaping_sword") !== null) {
                    $sender->setMotion(new Vector3(mt_rand(1, 2), mt_rand(1, 2), mt_rand(1, 2)));
                }
                if ($item->getNamedTag()->getTag("voterank") !== null) {
                    /** @var PurePerms */
                    $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
                    if ($purePerms->getUserDataMgr()->getData($sender)["group"] === "Member") {
                        $item->setCount($item->getCount() - 1);
                        $sender->getInventory()->setItemInHand($item);
                        MagicCore::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(MagicCore::getInstance()->getServer(), MagicCore::getInstance()->getServer()->getLanguage()), str_replace("{player}", $sender->getName(), Configuration::$voteVoucherCommand));
                        $sender->sendMessage(" §eVote Rank Voucher Successfully Claimed");
                    } else {
                        $sender->sendMessage(" §ePeople Having Member Rank Can Only Claim Voter Rank");
                    }
                }

                if ($item->getNamedTag()->getTag("profile") !== null) {
                    Server::getInstance()->dispatchCommand($sender, "profile");
                }
                if ($item->getNamedTag()->getTag("bag") !== null) {
                    Server::getInstance()->dispatchCommand($sender, "vaultui");
                }
                if ($item->getNamedTag()->getTag("bank") !== null) {
                    Server::getInstance()->dispatchCommand($sender, "bank");
                }
                break;
        }
    }

    public function onArenaDeath(PlayerDeathEvent $event): void
    {
        $player = $event->getPlayer();
        if ($player->getPosition()->getWorld()->getFolderName() === "MagicGames") {
            $aabb = new AxisAlignedBB(107.00, (float) World::Y_MIN, -74.00, 151.00, (float) World::Y_MAX, -30.00);
            if ($aabb->isVectorInXZ($player->getPosition())) {
                foreach ($event->getDrops() as $item) {
                    $player->getPosition()->getWorld()->dropItem($player->getLocation(), $item);
                }

                $player->getInventory()->setHeldItemIndex(0);
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
                $player->getOffHandInventory()->clearAll();
            }
        }
    }

    public function onArenaMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        if ($player->getPosition()->getWorld()->getFolderName() === "MagicGames") {
            $aabb = new AxisAlignedBB(105.00, (float) World::Y_MIN, -76.00, 153.00, (float) World::Y_MAX, -28.00);
            $aabb2 = new AxisAlignedBB(107.00, (float) World::Y_MIN, -74.00, 151.00, (float) World::Y_MAX, -30.00);
            if ($aabb->isVectorInXZ($player->getPosition()) && !$aabb2->isVectorInXZ($player->getPosition())) {
                $player->sendMessage(MagicCore::PREFIX . "PvP is enabled in this area. You will lose items if you die.");
            }
        }
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        $sender = $event->getPlayer();
        if (Configuration::$keepInventory && !in_array($event->getPlayer()->getWorld()->getDisplayName(), Configuration::$noKeepInventoryList)) {
            $event->setKeepInventory(true);
        } else {
            $event->setKeepInventory(false);
        }

        $lastDamage = $sender->getLastDamageCause();
        if (!$lastDamage instanceof EntityDamageByEntityEvent) {
            return;
        }

        $senderMoney = EconomyAPI::getInstance()->myMoney($sender);
        if (!is_bool($senderMoney)) {
            $damager = $lastDamage->getDamager();
            if (Configuration::$killMoneyLose) {
                if (!$damager instanceof Player) {
                    MagicCore::getInstance()->naturalMoneyLoss($sender, $senderMoney);
                    return;
                }
                switch (Configuration::$loseMoneyType) {
                    case "all":
                        if (Configuration::$killerGainMoney) {
                            $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . $senderMoney);
                            EconomyAPI::getInstance()->addMoney($damager, $senderMoney);
                        }
                        $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney);
                        break;
                    case "half":
                        if (Configuration::$killerGainMoney) {
                            $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . $senderMoney / 2);
                            EconomyAPI::getInstance()->addMoney($damager, $senderMoney / 2);
                        }
                        $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney / 2);
                        EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney / 2);
                        break;
                    case "amount":
                        if (Configuration::$killerGainMoney) {
                            $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . Configuration::$moneyLoseAmount);
                            EconomyAPI::getInstance()->addMoney($damager, Configuration::$moneyLoseAmount);
                        }
                        $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . Configuration::$moneyLoseAmount);
                        EconomyAPI::getInstance()->reduceMoney($sender, Configuration::$moneyLoseAmount);
                        break;
                    case "percent":
                        if (Configuration::$killerGainMoney) {
                            $damager->sendMessage("§c§lINFO > §r§bYou Have Killed §e " . $sender->getName() . " §bAnd Stole §e$" . (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                            EconomyAPI::getInstance()->addMoney($damager, (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                        }
                        $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($sender, (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                        break;
                }
            }
        }
    }

    public function onBucket(PlayerBucketEmptyEvent $event): void
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getNamedTag()->getTag("infi_bucket") !== null) {
            $player->getInventory()->setItemInHand($item);
        }
    }
}
