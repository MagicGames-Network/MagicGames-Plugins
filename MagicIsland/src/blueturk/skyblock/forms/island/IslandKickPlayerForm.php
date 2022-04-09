<?php

namespace blueturk\skyblock\forms\island;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class IslandKickPlayerForm extends MenuForm
{

    public function __construct(Player $player)
    {
        $options = [];
        $level = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        if (Server::getInstance()->getWorldManager()->isWorldLoaded($player->getName())) if ($level->getPlayers() != null) foreach ($level->getPlayers() as $player) $options[] = new MenuOption($player->getName());
        parent::__construct(SkyBlock::BT_TITLE . "Kick Player from the Island", "\n",
            $options, function (Player $player, int $option): void {
            $selectedPlayer = $this->getOption($option)->getText();
            IslandManager::islandKickPlayer($player, $selectedPlayer);
            }
        );
    }
}