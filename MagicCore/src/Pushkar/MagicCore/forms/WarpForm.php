<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use Pushkar\MagicCore\Main;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use pocketmine\world\Position;
use dktapps\pmforms\MenuOption;

class WarpForm extends MenuForm
{

    public function __construct(Main $main)
    {
        parent::__construct(
            "§6§lWARPS",
            "",
            [
                new MenuOption("§l§3PVP\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1496/1496125.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3FOREST\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3277/3277595.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3MINE\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4080/4080723.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3FARM\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/2921/2921855.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3GRAVEYARD\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4321/4321459.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3LIFT UI\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3321/3321009.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3ISLAND\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4617/4617270.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3HUB\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/602/602182.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3NETHER\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/512/3643/3643525.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3END\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1127/1127941.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3CRATES\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/512/1355/1355900.png", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§l§3LEADERBOARD\n§l§9»» §r§oTap to open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1426/1426727.png", FormIcon::IMAGE_TYPE_URL))
            ],
            function (Player $player, int $selected) use ($main): void {
                switch ($selected) {
                    case 0:
                        $world = $main->getConfig()->get("pvp-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("pvp-x")), floatval($main->getConfig()->get("pvp-y")), floatval($main->getConfig()->get("pvp-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lPVP");
                        break;

                    case 1:
                        $world = $main->getConfig()->get("forest-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("forest-x")), floatval($main->getConfig()->get("forest-y")), floatval($main->getConfig()->get("forest-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lFOREST");
                        break;

                    case 2:
                        $world = $main->getConfig()->get("mine-world");
                        $player->teleport(new Position(floatval($main->getConfig()->get("mine-x")), floatval($main->getConfig()->get("mine-y")), floatval($main->getConfig()->get("mine-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lMINE");
                        break;

                    case 3:
                        $world = $main->getConfig()->get("farm-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("farm-x")), floatval($main->getConfig()->get("farm-y")), floatval($main->getConfig()->get("farm-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lFARM");
                        break;

                    case 4:
                        $world = $main->getConfig()->get("grave-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("grave-x")), floatval($main->getConfig()->get("grave-y")), floatval($main->getConfig()->get("grave-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
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
                        $world = $main->getConfig()->get("nether-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("nether-x")), floatval($main->getConfig()->get("nether-y")), floatval($main->getConfig()->get("nether-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lNETHER");
                        break;

                    case 9:
                        $world = $main->getConfig()->get("end-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("end-x")), floatval($main->getConfig()->get("end-y")), floatval($main->getConfig()->get("end-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lEND");
                        break;

                    case 10:
                        $world = $main->getConfig()->get("crates-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("crates-x")), floatval($main->getConfig()->get("crates-y")), floatval($main->getConfig()->get("crates-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lCRATES");
                        break;

                    case 11:
                        $world = $main->getConfig()->get("leaderboard-world");

                        $player->teleport(new Position(floatval($main->getConfig()->get("leaderboard-x")), floatval($main->getConfig()->get("leaderboard-y")), floatval($main->getConfig()->get("leaderboard-z")), $main->getServer()->getWorldManager()->getWorldByName($world)));
                        $player->sendTitle("§e§lLEADERBOARD");
                        break;
                }
            }
        );
    }
}
