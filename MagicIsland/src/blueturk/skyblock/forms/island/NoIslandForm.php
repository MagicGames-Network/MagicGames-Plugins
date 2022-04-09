<?php

namespace blueturk\skyblock\forms\island;

use blueturk\skyblock\forms\island\partner\PartnerTeleportForm;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;

class NoIslandForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct(SkyBlock::BT_TITLE . "SkyBlock", "\n",
            [
                new MenuOption("§b» §3Island Types and Creation \n§8Click To Select", new FormIcon('https://cdn-icons-png.flaticon.com/128/619/619005.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Your Partner Islands \n§8Click To Select", new FormIcon('https://cdn-icons-png.flaticon.com/128/2010/2010261.png', FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§b» §3Visitable Islands \n§8Click To Select", new FormIcon('https://cdn-icons-png.flaticon.com/128/854/854878.png', FormIcon::IMAGE_TYPE_URL))
            ], function (Player $player, int $option): void {
                switch ($option) {
                    case 0:
                        $player->sendForm(new IslandTypeForm());
                        break;
                    case 1:
                        $player->sendForm(new PartnerTeleportForm($player));
                        break;
                    case 2:
                        $player->sendForm(new IslandVisitAllOpenForm());
                }
            }
        );
    }
}