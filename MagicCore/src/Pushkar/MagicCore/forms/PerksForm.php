<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class PerksForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§cPERKS","§6Please Select The Next Menu",[
            new MenuOption("§eNight Vision\n§8Click To Open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§eSpeed\n§8Click To Open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§cExit", new FormIcon("textures/blocks/barrier", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void{
            switch ($selected){
                case 0:
                 Server::getInstance()->dispatchCommand($sender, "vision");
                 break;
                 
                case 1:
                  Server::getInstance()->dispatchCommand($sender, "speed");
                 break;
            }
        });
    }

}