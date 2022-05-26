<?php

namespace NgLamVN\SmeltWands;

use pocketmine\item\ItemIds;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\block\tile\Chest;
use pocketmine\item\ItemFactory;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\tag\StringTag;
use pocketmine\plugin\PluginBase;
use pocketmine\block\VanillaBlocks;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerInteractEvent;

class SmeltWands extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        //TODO: Just a simple plugin, so I not use more class like EventListener.
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if (strtolower($command->getName()) !== "smeltwand") {
            return true;
        }

        if (!$sender->hasPermission("swand.give")) {
            $sender->sendMessage("NO PERM !");
            return true;
        }
        if (!isset($args[0])) {
            return false;
        }
        $player = $this->getServer()->getPlayerByPrefix($args[0]);
        if (!$player instanceof Player) {
            $sender->sendMessage("Player Not Found !");
            return true;
        }
        $item = VanillaItems::STICK();
        $item->setCustomName("§l§bSmelt Stick");
        $item->setLore(["§7Tap a chest to smelt items!", " ", "§6Uses: UNLIMITED"]);
        $item->getNamedTag()->setTag("smelt_stick", new StringTag(""));
        if (!$player->getInventory()->canAddItem($item)) {
            $sender->sendMessage($player->getName() . "'s inventory is full");
            return true;
        }
        $player->getInventory()->addItem($item);
        return true;
    }

    public function onTap(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $eItem = $event->getItem();
        $x = $block->getPosition()->x;
        $y = $block->getPosition()->y;
        $z = $block->getPosition()->z;
        $world = $block->getPosition()->getWorld();

        if (!$eItem->getNamedTag()->getTag("smelt_stick") instanceof StringTag) {
            return;
        }
        $title =  $world->getTile(new Vector3($x, $y, $z));
        if ($title instanceof Chest) {
            $inv = $title->getInventory();
            $items = $inv->getContents();
            foreach ($items as $item) {
                switch ($item->getId()) {
                        //TODO: VANILLA SMELT RECIPE INSTEAD OF CASE WHOLE OF ITEMS.
                    case 4:
                        $smelt = VanillaBlocks::STONE()->asItem()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::IRON_ORE:
                        $smelt = VanillaItems::IRON_INGOT()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::GOLD_ORE:
                        $smelt = VanillaItems::GOLD_INGOT()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::DIAMOND_ORE:
                        $smelt = VanillaItems::DIAMOND()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::LAPIS_ORE:
                        $smelt = VanillaItems::LAPIS_LAZULI()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::COAL_ORE:
                        $smelt = VanillaItems::COAL()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::EMERALD_ORE:
                        $smelt = VanillaItems::EMERALD()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::QUARTZ_ORE:
                        $smelt = VanillaItems::NETHER_QUARTZ()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::REDSTONE_ORE:
                        $smelt = VanillaItems::REDSTONE_DUST()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::LOG:
                        $smelt = VanillaItems::COAL()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::LOG2:
                        $smelt = VanillaItems::COAL()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::BEEF:
                        $smelt = ItemFactory::getInstance()->get(ItemIds::COOKED_BEEF, 0, $item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::CHICKEN:
                        $smelt = VanillaItems::COOKED_CHICKEN()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::FISH:
                        $smelt = VanillaItems::COOKED_FISH()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::SALMON:
                        $smelt = VanillaItems::COOKED_SALMON()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::RABBIT:
                        $smelt = VanillaItems::COOKED_RABBIT()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::MUTTON:
                        $smelt = VanillaItems::COOKED_MUTTON()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::PORKCHOP:
                        $smelt = VanillaItems::COOKED_PORKCHOP()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::POTATO:
                        $smelt = VanillaItems::BAKED_POTATO()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::KELP:
                        $smelt = VanillaItems::DRIED_KELP()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::SAND:
                        $smelt = VanillaBlocks::GLASS()->asItem()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::STONE:
                        $smelt = VanillaBlocks::SMOOTH_STONE()->asItem()->setCount($item->getCount() * 3);
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                        break;
                    case ItemIds::NETHERRACK:
                        $smelt = VanillaBlocks::NETHER_BRICKS()->asItem()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                    case ItemIds::CLAY:
                        $smelt = VanillaBlocks::BRICKS()->asItem()->setCount($item->getCount());
                        $inv->removeItem($item);
                        $inv->addItem($smelt);
                }
            }
            $player->sendMessage("Smelted !");
            $event->cancel();
        }
    }
}
