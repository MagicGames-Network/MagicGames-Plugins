<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class EnchantForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct(
            "§eEnchantment UI",
            "§6Please Select The Next Menu",
            [
                new MenuOption("§3Normal Enchantment\n§l§9»» §r§oTap to open", new FormIcon("https://image.flaticon.com/icons/png/128/2466/2466942.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§3Custom Enchantment\n§l§9»» §r§oTap to open", new FormIcon("https://image.flaticon.com/icons/png/128/1037/1037970.png", FormIcon::IMAGE_TYPE_URL))
            ],
            function (Player $player, int $selected): void {
                if ($selected === 0) {
                    Server::getInstance()->dispatchCommand($player, "es");
                } else {
                    Server::getInstance()->dispatchCommand($player, "ceshop");
                }
            }
        );
    }
}
