<?php

namespace blueturk\skyblock\forms\island;

use pocketmine\Server;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;
use blueturk\skyblock\managers\IslandManager;

class IslandBanPlayerForm extends MenuForm
{
    public function __construct(Player $player)
    {
        $options = [];
        $level = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        if (Server::getInstance()->getWorldManager()->isWorldLoaded($player->getName())) if ($level->getPlayers() != null) foreach ($level->getPlayers() as $player) $options[] = new MenuOption($player->getName());
        parent::__construct(
            SkyBlock::BT_TITLE . "Ban Players From Your Island",
            "\n",
            $options,
            function (Player $player, int $option): void {
                $selectedPlayer = $this->getOption($option)->getText();
                IslandManager::islandBanPlayer($player, $selectedPlayer);
            }
        );
    }
}
