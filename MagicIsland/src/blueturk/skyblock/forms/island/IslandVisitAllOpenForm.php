<?php

namespace blueturk\skyblock\forms\island;

use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;
use blueturk\skyblock\managers\IslandManager;

class IslandVisitAllOpenForm extends MenuForm
{
    public function __construct()
    {
        $options = [];
        $visits = SkyBlock::getInstance()->getConfig()->getNested("Visits");
        if (!is_array($visits)) {
            $visits = [];
        }

        foreach ($visits as $item => $value) {
            if ($value === true) {
                $options[] = new MenuOption($item);
            }
        }
        parent::__construct(
            SkyBlock::BT_TITLE . "Players Open to Visit",
            "\n",
            $options,
            function (Player $player, int $option): void {
                $menuOption = $this->getOption($option);
                if (!$menuOption instanceof MenuOption) {
                    return;
                }

                $selectedPlayer = $menuOption->getText();
                IslandManager::islandVisit($player, $selectedPlayer);
            }
        );
    }
}
