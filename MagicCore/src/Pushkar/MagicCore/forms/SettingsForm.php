<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class SettingsForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eSettings", "§bYour Personal Setting", [
            new MenuOption("§l§3NICKNAME\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3CAPES\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3HIDE PLAYERS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3PETS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3SIZE\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3PERKS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3VANISH\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3VAULT\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§cExit", new FormIcon("textures/blocks/barrier", FormIcon::IMAGE_TYPE_PATH))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "nickname");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "cape");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "hide");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "pets");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($sender, "size");
                    break;

                case 5:
                    $sender->sendForm(new Perksform());
                    break;

                case 6:
                    $sender->sendForm(new Vanishform());
                    break;

                case 7:
                    $sender->sendMessage("§l§cERROR>§rVault Feature Coming Soon");
                    $sender->sendTitle("§l§6COMING SOON");
                    break;
                case 8:
                    break;
            }
        });
    }
}
