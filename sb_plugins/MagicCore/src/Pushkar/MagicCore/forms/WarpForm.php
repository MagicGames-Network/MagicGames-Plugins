<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use pocketmine\world\World;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use pocketmine\world\Position;
use dktapps\pmforms\MenuOption;
use Pushkar\MagicCore\MagicCore;

class WarpForm extends MenuForm
{

    public function __construct(MagicCore $MagicCore)
    {
        parent::__construct(
            "§6§lWARPS",
            "",
            [
                new MenuOption("§l§bPVP\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1496/1496125.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bFOREST\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3277/3277595.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bMINE\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4080/4080723.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bFARM\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/2921/2921855.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bGRAVEYARD\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4321/4321459.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bLIFT UI\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3321/3321009.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bISLAND\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4617/4617270.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bHUB\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/602/602182.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bNETHER\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/512/3643/3643525.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bEND\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1127/1127941.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bCRATES\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/512/1355/1355900.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§bLEADERBOARD\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1426/1426727.png", FormIcon::IMAGE_TYPE_URL))
            ],
            function (Player $player, int $selected) use ($MagicCore): void {
                switch ($selected) {
                    case 0:
                        $player->sendMessage(" §eComing Soon!");
                        break;
                    case 1:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(-279, 82, -12, $world));
                        $player->sendTitle("§e§lFOREST");
                        break;
                    case 2:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("Mining");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(-300, 111, 107, $world));
                        $player->sendTitle("§e§lMINE");
                        break;
                    case 3:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(115, 71, -211, $world));
                        $player->sendTitle("§e§lFARM");
                        break;
                    case 4:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(-104, 72, -137, $world));
                        $player->sendTitle("§e§lGRAVEYARD");
                        break;
                    case 5:
                        Server::getInstance()->dispatchCommand($player, "liftui");
                        break;
                    case 6:
                        Server::getInstance()->dispatchCommand($player, "join");
                        $player->sendTitle("§e§lISLAND");
                        break;
                    case 7:
                        Server::getInstance()->dispatchCommand($player, "hub");
                        $player->sendTitle("§e§lHUB");
                        break;
                    case 8:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(-309, 83, -385, $world));
                        $player->sendTitle("§e§lNETHER");
                        break;
                    case 9:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(-608, 22, -275, $world));
                        $player->sendTitle("§e§lEND");
                        break;
                    case 10:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(4, 73, -107, $world));
                        $player->sendTitle("§e§lCRATES");
                        break;
                    case 11:
                        $world = $MagicCore->getServer()->getWorldManager()->getWorldByName("MagicGames");
                        if (!$world instanceof World) {
                            break;
                        }

                        $player->teleport(new Position(4, 73, 152, $world));
                        $player->sendTitle("§e§lLEADERBOARD");
                        break;
                }
            }
        );
    }
}
