<?php

namespace blueturk\skyblock\forms\island\partner;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\ModalForm;
use pocketmine\player\Player;

class PartnerRequestForm extends ModalForm
{

    public function __construct(Player $requestPlayer)
    {
        parent::__construct(SkyBlock::BT_TITLE . "Partnership Request", $requestPlayer->getName() . "The player wants to add you to his/her island as a partner!",
            function (Player $player, bool $choice) use ($requestPlayer): void {
                if ($choice === true) IslandManager::partnerRequestConfirm($player, $requestPlayer->getName());
                if ($choice === false) {
                    $player->sendMessage(SkyBlock::BT_MARK . "bYou did not accept the partner offer!");
                    if ($requestPlayer->isOnline()) {
                        $requestPlayer->sendMessage(SkyBlock::BT_MARK . "bPartnership did not accept your offer!");
                    }
                }
            },
            "Admit it",
            "reject"
        );
    }
}