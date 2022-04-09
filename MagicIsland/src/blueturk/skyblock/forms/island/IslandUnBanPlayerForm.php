<?php

namespace blueturk\skyblock\forms\island;

use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;
use blueturk\skyblock\managers\IslandManager;

class IslandUnBanPlayerForm extends MenuForm
{
    public function __construct(Player $player)
    {
        $options = [];
        foreach (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".banneds") as $item => $value) {
            $options[] = new MenuOption($value);
        }
        parent::__construct(
            SkyBlock::BT_TITLE . "Remove Player Ban",
            "\n",
            $options,
            function (Player $player, int $option): void {
                $selectedPlayer = $this->getOption($option)->getText();
                IslandManager::islandUnBanPlayer($player, $selectedPlayer);
            }
        );
    }
}
