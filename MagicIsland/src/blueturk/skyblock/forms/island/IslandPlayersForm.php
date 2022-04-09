<?php

namespace blueturk\skyblock\forms\island;

use pocketmine\Server;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuOption;

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
