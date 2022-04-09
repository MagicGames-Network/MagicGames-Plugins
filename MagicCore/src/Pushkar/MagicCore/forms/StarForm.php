<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class StarForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eMagic Skyblock", "§6Please Select The Next Menu", [
            new MenuOption("§l§3SKYBLOCK MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/star", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3SHOP MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/shop", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3ENCHANTER MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/enchant", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3JOB MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/job", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3KIT MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/kit", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3TELEPORT HUB\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/hub", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3QUEST MENU\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/quest", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3CRAFTING RECIPES\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/recipe", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3WARPS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/warp", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3BANK\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/bank", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3ENDER CHEST\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/chest", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3BAZAAR\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/bazaar", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3OTHER SERVERS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/server", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§3SETTINGS\n§l§9»» §r§oTap to open", new FormIcon("textures/icon/settings", FormIcon::IMAGE_TYPE_PATH))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "is ui");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "shop");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "enchantui");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "job");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "kit");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "hub");
                    break;
                case 6:
                    Server::getInstance()->dispatchCommand($sender, "sb quest");
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "recipes");
                    break;
                case 8:
                    Server::getInstance()->dispatchCommand($sender, "warp");
                    break;
                case 9:
                    Server::getInstance()->dispatchCommand($sender, "bank");
                    break;
                case 10:
                    Server::getInstance()->dispatchCommand($sender, "echest");
                    break;
                case 11:
                    Server::getInstance()->dispatchCommand($sender, "bazaar");
                    break;
                case 12:
                    Server::getInstance()->dispatchCommand($sender, "servers");
                    break;
                case 13:
                    Server::getInstance()->dispatchCommand($sender, "settings");
                    break;
            }
        });
    }
}
