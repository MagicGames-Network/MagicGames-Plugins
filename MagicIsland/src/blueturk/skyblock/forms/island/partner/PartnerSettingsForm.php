<?php

namespace blueturk\skyblock\forms\island\partner;

use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\CustomForm;
use dktapps\pmforms\element\Toggle;
use dktapps\pmforms\CustomFormResponse;
use blueturk\skyblock\managers\IslandManager;

class PartnerSettingsForm extends CustomForm
{
    public function __construct(Player $player)
    {
        $data = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".settings");
        parent::__construct(
            SkyBlock::BT_TITLE . "Partner Settings",
            [
                new Toggle("interact", "§d§l»§r §bInteract", $data["interact"]),
                new Toggle("place", "§d§l»§r §bPlace", $data["place"]),
                new Toggle("break", "§d§l»§r §bBreak", $data["break"]),
                new Toggle("picking-up", "§d§l»§r §bReceiving Items from the Ground", $data["picking-up"]),
                new Toggle("de-active-teleport", "§d§l»§r §bTeleport While Inactive", $data["de-active-teleport"])
            ],
            function (Player $player, CustomFormResponse $response): void {
                $interact = $response->getBool("interact");
                $place = $response->getBool("place");
                $break = $response->getBool("break");
                $pickingUp = $response->getBool("picking-up");
                $deActiveTeleport = $response->getBool("de-active-teleport");
                IslandManager::changePartnerSettings($player, $interact, $place, $break, $pickingUp, $deActiveTeleport);
            }
        );
    }
}
