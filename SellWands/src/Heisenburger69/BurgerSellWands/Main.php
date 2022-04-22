<?php

declare(strict_types=1);

namespace Heisenburger69\BurgerSellWands;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\nbt\tag\IntTag;
use pocketmine\world\Position;
use AndreasHGK\SellAll\SellAll;
use pocketmine\command\Command;
use pocketmine\block\tile\Chest;
use pocketmine\item\ItemFactory;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;
use pocketmine\block\BlockLegacyIds;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as C;
use pocketmine\event\player\PlayerInteractEvent;

class Main extends PluginBase implements Listener
{
    public Config $cfg;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "sellwand":
                if (!$sender->hasPermission("sellwand.command")) {
                    $sender->sendMessage(C::colorize(C::RED . "You do not have permission to execute this command."));
                    return false;
                }
                if (!isset($args[0])) {
                    $sender->sendMessage(C::RED . "Use /sellwand <player> <uses>");
                    return false;
                }
                $player = $this->getServer()->getPlayerByPrefix($args[0]);
                if (!$player instanceof Player) {
                    $sender->sendMessage(C::RED . "Player not found!");
                    return false;
                }
                if (isset($args[1])) {
                    $uses = intval($args[1]);
                } else {
                    $uses = -1;
                }
                $item = $this->constructWand($uses);
                $player->getInventory()->addItem($item);
                return true;
            default:
                return false;
        }
    }

    /**
     * @param PlayerInteractEvent $event
     * @priority MONITOR
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        if ($event->getAction() !== PlayerInteractEvent::RIGHT_CLICK_BLOCK) {
            return;
        }

        $wand = $event->getItem();
        $nbt = $wand->getNamedTag()->getTag("sellwand");
        $block = $event->getBlock();

        if (!$nbt instanceof IntTag) {
            return;
        }

        $player = $event->getPlayer();

        if (!$player->hasPermission("sellwand.use")) {
            $noPerms = $this->cfg->get("sell-wand-no-permission-message");
            if (!is_string($noPerms)) {
                $noPerms = "&cYou do not have permission to use Sell Wands";
            }
            $player->sendMessage(C::colorize($noPerms));
            return;
        }

        if ($event->isCancelled()) {
            $cantUseHere = $this->cfg->get("sell-wand-cant-use-here-message");
            if (!is_string($cantUseHere)) {
                $cantUseHere = "&cYou cannot use Sell Wands here!";
            }
            $player->sendMessage(C::colorize($cantUseHere));
            return;
        }


        if ($block->getId() === BlockLegacyIds::CHEST) {
            $x = $block->getPosition()->x;
            $y = $block->getPosition()->y;
            $z = $block->getPosition()->z;
            $world = $block->getPosition()->getWorld();

            $chest = $world->getTile(new Position($x, $y, $z, $world));
            if ($chest instanceof Chest) {
                $sellPrices = SellAll::getInstance()->getConfig()->getAll();
                $inv = $chest->getInventory()->getContents();
                $revenue = 0;
                
                /** @var Item $item */
                foreach ($inv as $item) {
                    if (isset($sellPrices[$item->getId() . ":" . $item->getMeta()])) {
                        $revenue = $revenue + ($item->getCount() * $sellPrices[$item->getId() . ":" . $item->getMeta()]);
                        $chest->getInventory()->remove($item);
                    } elseif (isset($sellPrices[$item->getId()])) {
                        $revenue = $revenue + ($item->getCount() * $sellPrices[$item->getId()]);
                        $chest->getInventory()->remove($item);
                    }
                }

                if ($revenue <= 0) {
                    $noSellables = $this->cfg->get("sell-wand-no-items-message");
                    if (!is_string($noSellables)) {
                        $noSellables = "&cThere are no items to sell in this Chest";
                    }
                    $player->sendMessage(C::colorize($noSellables));
                    $event->cancel();
                    return;
                }

                $usedMsg = $this->cfg->get("sell-wand-use-message");
                if (!is_string($usedMsg)) {
                    $usedMsg = "&a&lSuccess! &r&7sold the contents of the Chest for §8\${MONEY}";
                }
                $player->sendMessage(C::colorize(str_replace("{MONEY}", (string)$revenue, $usedMsg)));
                EconomyAPI::getInstance()->addMoney($player->getName(), (int)$revenue);
                $this->subtractUse($wand, $player);
                $event->cancel();
            }
        }
    }

    /**
     * @param int $uses
     * @return Item
     */
    public function constructWand(int $uses): Item
    {
        $id = $this->cfg->get("sell-wand-item-id");
        if (!is_int($id)) {
            $id = ItemIds::WOODEN_HOE;
        }
        $item = ItemFactory::getInstance()->get($id);
        $item->getNamedTag()->setTag("sellwand", new IntTag($uses));

        if ($uses < 0) {
            $uses = "Unlimited";
        }

        $lore = $this->cfg->get("sell-wand-item-lore");
        if (!is_array($lore)) {
            $lore = [
                C::GRAY . "Tap a Chest to sell its contents",
                " ",
                C::YELLOW . "Remaining Uses: " . C::GREEN . $uses
            ];
            $item->setLore($lore);
        } else {
            $coloredLore = [];
            foreach ($lore as $line) {
                $line = str_replace("{USES}", (string)$uses, $line);
                $line = C::RESET . C::colorize($line);
                $coloredLore[] = $line;
            }
            $item->setLore($coloredLore);
        }

        $name = $this->cfg->get("sell-wand-item-name");
        if (!is_string($name)) {
            $name = "&l&bSell Wand";
        }
        $item->setCustomName(C::RESET . C::colorize($name));
        return $item;
    }

    public function subtractUse(Item $item, Player $player): void
    {
        $nbt = $item->getNamedTag()->getTag("sellwand");
        if (!$nbt instanceof IntTag) {
            return;
        }

        $value = $nbt->getValue();
        $value--;

        if ($value === 0) {
            $player->sendMessage(C::RED . "Your Sell Wand broke!");
            $player->getInventory()->setItemInHand(VanillaItems::AIR());
            return;
        }

        $wand = $this->constructWand($value);
        $player->getInventory()->setItemInHand($wand);
    }
}
