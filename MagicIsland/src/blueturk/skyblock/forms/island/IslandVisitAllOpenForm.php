<?php

namespace blueturk\skyblock\forms\island;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;

class IslandVisitAllOpenForm extends MenuForm
{

    public function __construct()
    {
        $options = [];
        if (SkyBlock::getInstance()->getConfig()->getNested("Visits") != null) {
            foreach (SkyBlock::getInstance()->getConfig()->getNested("Visits") as $item => $value) {
                if ($value === true) {
                    $options[] = new MenuOption($item);
                }
            }
        }
        parent::__construct(SkyBlock::BT_TITLE . "Players Open to Visit", "\n",
            $options, function (Player $player, int $option): void {
                $selectedPlayer = $this->getOption($option)->getText();
                IslandManager::islandVisit($player, $selectedPlayer);
            }
        );
    }
}