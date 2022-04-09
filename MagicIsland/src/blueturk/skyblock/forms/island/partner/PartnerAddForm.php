<?php

namespace blueturk\skyblock\forms\island\partner;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class PartnerAddForm extends MenuForm
{

    public function __construct()
    {
        $options = [];
        foreach (Server::getInstance()->getOnlinePlayers() as $onlinePlayer) {
            $options[] = new MenuOption($onlinePlayer->getName());
        }
        parent::__construct(SkyBlock::BT_TITLE . "Add Partner", "Select the player you want to add a partner!",
         $options, function (Player $player, int $option): void {
            $selectedPlayer = $this->getOption($option)->getText();
            IslandManager::partnerRequest($player, $selectedPlayer);
            }
        );
    }
}