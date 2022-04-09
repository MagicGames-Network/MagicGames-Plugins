<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class CustomArmorForm extends MenuForm
{
    
    public function __construct()
    {
        parent::__construct("§l§6CUSTOM ARMORS","§l§3Select The Custom Armor:",
        [
            new MenuOption("§l§eGod Armor"),
        new MenuOption("§l§eMiner Armor"),
        new MenuOption("§l§eFarmer Armor"),
        new MenuOption("§l§eLapis Armor"),
        new MenuOption("§l§eEnd Armor"),
        new MenuOption("§l§eGolem Armor"),
        new MenuOption("§l§ePumpkin Armor"),
        new MenuOption("§l§eNether Armor"),
        new MenuOption("§l§eOak Armor"),
        new MenuOption("§l§eIce Armor"),
        new MenuOption("§l§eAssassin Armor"),
        new MenuOption("§l§eTank Armor"),
        new MenuOption("§l§eWise Armor"),
        new MenuOption("§l§eEmerald Armor"),
        new MenuOption("§l§eRedstone Armor"),
        new MenuOption("§l§eUnstable Armor"),
        new MenuOption("§l§eSpider Armor"),
        new MenuOption("§l§eDigger Armor"),
        new MenuOption("§l§eTechno Armor"),
        new MenuOption("§l§eLiqued Armor"),
        new MenuOption("§l§ePiginity Armor"),
        new MenuOption("§l§eFrosved Armor"),
        new MenuOption("§l§eFur Armor"),
        new MenuOption("§l§eLucario Armor"),
        new MenuOption("§l§eLucid Armor"),
        new MenuOption("§l§eWise Armor"),
        new MenuOption("§l§eMagma Armor"),
        new MenuOption("§l§eCoal Armor"),
        new MenuOption("§l§eSuperior Armor"),
        new MenuOption("§l§eSpeeder Armor")
        ], function (Player $player, int $selected): void {
            $ca = $player->getName();
            switch ($selected) {
                case 0:
                    Server::getInstance()->dispatchCommand($player, "customarmor God full $ca");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($player, "customarmor Miner full $ca");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($player, "customarmor Farmer full $ca");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($player, "customarmor Lapis full $ca");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($player, "customarmor End full $ca");
                    break;

                case 5:
                    Server::getInstance()->dispatchCommand($player, "customarmor Golem full $ca");
                    break;

                case 6:
                    Server::getInstance()->dispatchCommand($player, "customarmor Pumpkin full $ca");
                    break;

                case 7:
                    Server::getInstance()->dispatchCommand($player, "customarmor Nether full $ca");
                    break;

                case 8:
                    Server::getInstance()->dispatchCommand($player, "customarmor Oak full $ca");
                    break;

                case 9:
                    Server::getInstance()->dispatchCommand($player, "customarmor Ice full $ca");
                    break;

                case 10:
                    Server::getInstance()->dispatchCommand($player, "customarmor Assassin full $ca");
                    break;

                case 11:
                    Server::getInstance()->dispatchCommand($player, "customarmor Tank full $ca");
                    break;

                case 12:
                    Server::getInstance()->dispatchCommand($player, "customarmor Wise full $ca");
                    break;

                case 13:
                    Server::getInstance()->dispatchCommand($player, "customarmor Emerald full $ca");
                    break;

                case 14:
                    Server::getInstance()->dispatchCommand($player, "customarmor Redstone full $ca");
                    break;

                case 15:
                    Server::getInstance()->dispatchCommand($player, "customarmor Unstable full $ca");
                    break;

                case 16:
                    Server::getInstance()->dispatchCommand($player, "customarmor Spider full $ca");
                    break;

                case 17:
                    Server::getInstance()->dispatchCommand($player, "customarmor Digger full $ca");
                    break;

                case 18:
                    Server::getInstance()->dispatchCommand($player, "customarmor Techno full $ca");
                    break;

                case 19:
                    Server::getInstance()->dispatchCommand($player, "customarmor Liqued full $ca");
                    break;

                case 20:
                    Server::getInstance()->dispatchCommand($player, "customarmor Piginity full $ca");
                    break;

                case 21:
                    Server::getInstance()->dispatchCommand($player, "customarmor Frosved full $ca");
                    break;

                case 22:
                    Server::getInstance()->dispatchCommand($player, "customarmor Fur full $ca");
                    break;

                case 23:
                    Server::getInstance()->dispatchCommand($player, "customarmor Lucario full $ca");
                    break;

                case 24:
                    Server::getInstance()->dispatchCommand($player, "customarmor Lucid full $ca");
                    break;

                case 25:
                    Server::getInstance()->dispatchCommand($player, "customarmor Wise full $ca");
                    break;

                case 26:
                    Server::getInstance()->dispatchCommand($player, "customarmor Magma full $ca");
                    break;

                case 27:
                    Server::getInstance()->dispatchCommand($player, "customarmor Coal full $ca");
                    break;

                case 28:
                    Server::getInstance()->dispatchCommand($player, "customarmor Superior full $ca");
                    break;

                case 29:
                    Server::getInstance()->dispatchCommand($player, "customarmor Speeder full $ca");
                    break;
            }
            });
    }
}