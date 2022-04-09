<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class InvclearForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eInvClear", "§cIt Will Clear Your Inventory\n§bYou Can't Get Your Items Back After Inv Clear", [
            new MenuOption("§c» Yes «", new FormIcon("https://cdn-icons-png.flaticon.com/128/3572/3572255.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§6» Cancel «", new FormIcon("https://cdn-icons-png.flaticon.com/128/3572/3572260.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $player, int $selected): void {
            switch ($selected) {
                case 0:
                    $player->sendMessage("§e§lMAGICGAMES > §r§bClearing Armor Inventory....");
                    $player->getArmorInventory()->clearAll();
                    $player->sendMessage("§e§lMAGICGAMES > §r§bClearing Player Inventory....");
                    $player->getInventory()->clearAll();
                    $player->sendMessage("§e§lMAGICGAMES > §r§bInventory Cleared Successfully!");
                    break;
                case 1:
                    $player->sendMessage("§e§lMAGICGAMES > §r§bYou Canceled The Inv Clear Process.");
                    break;
            }
        });
    }
}
