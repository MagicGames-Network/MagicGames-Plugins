<?php

namespace blueturk\skyblock\forms\island;

use Exception;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;
use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\forms\island\partner\PartnerOptionsForm;
use blueturk\skyblock\forms\island\partner\PartnerTeleportForm;

class IslandOptionsForm extends MenuForm
{

    public function __construct(Player $player)
    {
        $visitStatus = SkyBlock::getInstance()->getConfig()->getNested("Visits." . $player->getName());
        if (!is_bool($visitStatus)) {
            return;
        }
        
        parent::__construct(
            SkyBlock::BT_TITLE . "Island",
            "",
            [
                new MenuOption("Teleport To Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/619/619005.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Teleport to Partner Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/2010/2010261.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Partner Options\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/3315/3315183.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Set Island Spawn\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/5569/5569268.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Island Visit: " . ($visitStatus === true ? "§l§2OPEN" : "§l§4CLOSED") . "\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/1541/1541400.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Visitable Islands\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/854/854878.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Players on the Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/166/166344.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Kick Player From Your Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/4578/4578073.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Ban Players From Your Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/1595/1595649.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Unban Banned Player\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/3699/3699516.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("Delete Your Island\n§d§l»§r §7Tap to select!", new FormIcon('https://cdn-icons-png.flaticon.com/128/3496/3496416.png', FormIcon::IMAGE_TYPE_URL))
            ],
            function (Player $player, int $option) use ($visitStatus): void {
                switch ($option) {
                    case 0:
                        IslandManager::teleportToIsland($player);
                        break;
                    case 1:
                        $player->sendForm(new PartnerTeleportForm($player));
                        break;
                    case 2:
                        $player->sendForm(new PartnerOptionsForm());
                        break;
                    case 3:
                        IslandManager::setIslandSpawnLocation($player);
                        break;
                    case 4:
                        IslandManager::changeIslandVisit($player, $visitStatus);
                        break;
                    case 5:
                        $player->sendForm(new IslandVisitAllOpenForm());
                        break;
                    case 6:
                        $player->sendForm(new IslandPlayersForm($player));
                        break;
                    case 7:
                        $player->sendForm(new IslandKickPlayerForm($player));
                        break;
                    case 8:
                        $player->sendForm(new IslandBanPlayerForm($player));
                        break;
                    case 9:
                        $player->sendForm(new IslandUnBanPlayerForm($player));
                        break;
                    case 10:
                        IslandManager::islandRemove($player);
                        break;
                    default:
                        throw new Exception('Unexpected value');
                }
            }
        );
    }
}
