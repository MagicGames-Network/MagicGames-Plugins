<?php

namespace blueturk\skyblock\forms\island;

use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class IslandPlayersForm extends MenuForm
{

    public function __construct(Player $player)
    {
        $options = [];
        $level = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        if ($level->getPlayers() != null) foreach ($level->getPlayers() as $player) $options[] = new MenuOption($player->getNameTag());
        parent::__construct(SkyBlock::BT_TITLE . "Players on the Island", "\n", $options, function (Player $player, int $option): void {
        });
    }
}