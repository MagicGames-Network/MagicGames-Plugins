<?php

declare(strict_types=1);

namespace Aericio\PCEBookShop;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\utils\TextFormat;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;

class EventListener implements Listener
{

    private PCEBookShop $plugin;

    public function __construct(PCEBookShop $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onPlayerInteractEvent(PlayerInteractEvent $event): void
    {
        
        $item = $event->getItem();
        $player = $event->getPlayer();
        if ($item->getId() !== ItemIds::BOOK) return;
        if ($item->getNamedTag()->getTag("ceshop") !== null) {
            $event->cancel();
            $nbt = $item->getNamedTag()->getInt("ceshop");
            $enchants = $this->plugin->getEnchantmentsByRarity($nbt);
            $enchant = $enchants[array_rand($enchants)];
            if ($enchant instanceof CustomEnchant) {
                $item = ItemFactory::getInstance()->get(ItemIds::ENCHANTED_BOOK);
                $item->setCustomName(TextFormat::RESET . $this->plugin->getMessage("item.unused-name") . TextFormat::RESET);
                $item->setLore(array(TextFormat::EOL . "§eDescription:§f " . $enchant->getDescription() . TextFormat::EOL . "§eType:§f " . Utils::TYPE_NAMES[$enchant->getItemType()] . TextFormat::EOL . "§eRarity:§f " . Utils::RARITY_NAMES[$enchant->getRarity()]. TextFormat::EOL . "§e---------------"));
                $item->addEnchantment(new EnchantmentInstance($enchant, $this->plugin->getRandomWeightedElement($enchant->getMaxLevel())));
                $inventory = $player->getInventory();
                if ($inventory->canAddItem($item)) {
                    $inventory->removeItem($inventory->getItemInHand()->pop());
                    $inventory->addItem($item->pop());
                    return;
                }
                $player->sendMessage($this->plugin->getMessage("inventory-full"));
            }
        }
    }
}
