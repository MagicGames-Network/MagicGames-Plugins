<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class StarForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eMagic Skyblock","§6Please Select The Next Menu",[
            new MenuOption("§l§3SKYBLOCK MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/star", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3SHOP MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/shop", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3ENCHANTER MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/enchant", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3JOB MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/job", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3KIT MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/kit", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3TELEPORT HUB\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/hub", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3QUEST MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/quest", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3CRAFTING RECIPES\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/recipe", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3WARPS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/warp", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3BANK\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/bank", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3ENDER CHEST\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/chest", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3BAZAAR\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/bazaar", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3OTHER SERVERS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/server", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§3SETTINGS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void{
            switch ($selected){
                case 0:
                Server::getInstance()->dispatchCommand($sender, "is ui", FormIcon::IMAGE_TYPE_URL);
                break;
                case 1:
                 Server::getInstance()->dispatchCommand($sender, "shop", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 2:
                 Server::getInstance()->dispatchCommand($sender, "enchantui", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 3:
                 Server::getInstance()->dispatchCommand($sender, "job", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 4:
                 Server::getInstance()->dispatchCommand($sender, "kit", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 5:
                 Server::getInstance()->dispatchCommand($sender, "hub", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 6:
                 Server::getInstance()->dispatchCommand($sender, "sb quest", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 7:
                 Server::getInstance()->dispatchCommand($sender, "recipes", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 8:
                 Server::getInstance()->dispatchCommand($sender, "warp", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 9:
                 Server::getInstance()->dispatchCommand($sender, "bank", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 10:
                 Server::getInstance()->dispatchCommand($sender, "echest", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 11:
                 Server::getInstance()->dispatchCommand($sender, "bazaar", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 12:
                 Server::getInstance()->dispatchCommand($sender, "servers", FormIcon::IMAGE_TYPE_URL);
                 break;
                case 13:
                 Server::getInstance()->dispatchCommand($sender, "settings", FormIcon::IMAGE_TYPE_URL);
                 break;
            }
        });
    }

}