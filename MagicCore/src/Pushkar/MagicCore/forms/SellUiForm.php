<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class SellUiForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eMagic Sell Items", "§6Please Select The Next Menu", [
            new MenuOption("§l§3SELL HAND\n§l§9»» §r§oTap To Sell", new FormIcon("https://i.imgur.com/rJgCB9G.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3SELL ORE\n§l§9»» §r§oTap To Sell", new FormIcon("https://i.imgur.com/85cNpjb.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3SELL INVENTORY\n§l§9»» §r§oTap To Sell", new FormIcon("https://i.imgur.com/CxNRCAp.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $player, int $selected): void {
            switch ($selected) {
                case 0:
                    Server::getInstance()->dispatchCommand($player, "sell hand");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($player, "sell ore");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($player, "sell all");
                    break;
            }
        });
    }
}
