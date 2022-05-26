<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use pocketmine\item\ItemFactory;

class TradeForm extends MenuForm
{
    public function __construct()
    {
        parent::__construct("§eJerry trade menu", "§bHere You Can Trade Jerry With Specific Items", [
            new MenuOption("§e4x Dirt = §b1x Grass"),
            new MenuOption("§e2x CobbleStone = §b1x Stone")
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->trade($sender, 3, 2, 4, 1);
                    break;
                case 1:
                    $this->trade($sender, 4, 1, 2, 1);
                    break;
            }
        });
    }

    public function getItemCount(Player $player, int $id): int
    {
        $count = 0;
        foreach ($player->getInventory()->getContents() as $item) {
            if ($item->getId() === $id)
                $count = $count + $item->getCount();
        }
        return $count;
    }

    public function trade(Player $player, int $id1, int $id2, int $quantity1, int $quantity2): void
    {
        $item1 = ItemFactory::getInstance()->get($id1, 0, $quantity1);
        $item2 = ItemFactory::getInstance()->get($id2, 0, $quantity2);
        if ($this->getItemCount($player, $id1) < $quantity1) {
            $player->sendMessage(" §cYou Don't Have Enough Items To Trade!");
            return;
        }
        $inv = $player->getInventory();
        $inv->removeItem($item1);
        $inv->addItem($item2);
    }
}
