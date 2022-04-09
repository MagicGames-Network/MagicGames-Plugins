<?php

namespace blueturk\skyblock\forms\island;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;

class IslandTypeForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct(
            SkyBlock::BT_TITLE . "Create an Island",
            "§7Choose the type of island you want to create.\n",
            [
                new MenuOption("§b» §3Basic Island \n§8Click To Select", new FormIcon('https://i.postimg.cc/DfxfRRTz/Basic-Island.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Beach \n§8Click To Select", new FormIcon('https://i.postimg.cc/hvfkkyLJ/Beach.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Resort \n§8Click To Select", new FormIcon('https://i.postimg.cc/D0H9nr6x/Resort.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Villa \n§8Click To Select", new FormIcon('https://i.postimg.cc/cJhPryTg/Villa.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Fantasty \n§8Click To Select", new FormIcon('https://i.postimg.cc/zXRmpQD6/Fantasty.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Javanese \n§8Click To Select", new FormIcon('https://i.postimg.cc/4xVg4SrV/Javanese.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Musroom \n§8Click To Select", new FormIcon('https://i.postimg.cc/0j4srRkd/Musroom.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3NetherIsland \n§8Click To Select", new FormIcon('https://i.postimg.cc/ZK9m2RHf/Nether.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Desert \n§8Click To Select", new FormIcon('https://i.postimg.cc/dQNv5d2k/Desert.png', FormIcon::IMAGE_TYPE_URL))
            ],
            function (Player $player, int $option): void {
                switch ($option) {
                    case 0:
                        $player->sendForm(new IslandCreateConfirmForm("BasicIsland"));
                        break;
                    case 1:
                        $player->sendForm(new IslandCreateConfirmForm("Beach"));
                        break;
                    case 2:
                        $player->sendForm(new IslandCreateConfirmForm("Resort"));
                        break;
                    case 3:
                        $player->sendForm(new IslandCreateConfirmForm("Villa"));
                        break;
                    case 4:
                        $player->sendForm(new IslandCreateConfirmForm("Fantasty"));
                        break;
                    case 5:
                        $player->sendForm(new IslandCreateConfirmForm("Javanese"));
                        break;
                    case 6:
                        $player->sendForm(new IslandCreateConfirmForm("Musroom"));
                        break;
                    case 7:
                        $player->sendForm(new IslandCreateConfirmForm("NetherIsland"));
                        break;
                    case 8:
                        $player->sendForm(new IslandCreateConfirmForm("Desert"));
                        break;
                }
            }
        );
    }
}
