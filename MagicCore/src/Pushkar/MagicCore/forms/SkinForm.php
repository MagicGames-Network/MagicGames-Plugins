<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\element\StepSlider;

class SkinForm extends MenuForm
{

    /*public function __construct(Player $sender)
    {
        parent::__construct("§l§aSelect Player Skin", "§6Please Select The Next Menu", [
            new StepSlider("", "", $this->players[$sender->getName()]),
        ], function (Player $player, int $selected): void {
            $list = [];
            foreach ($this->plugin->getServer()->getOnlinePlayers() as $sender) {
                $list[] = $sender->getName();
            }
            $this->players[$sender->getName()] = $list;
            $dataSelected = Server::getInstance()->getPlayer($this->players[$sender->getName()][$data[1]]);
            $otherSkin = $dataSelected->getSkin();
            $sender->sendMessage("§aYou Stole {$dataSelected->getName()} Skin!");
            $sender->setSkin($otherSkin);
            $sender->sendSkin();
            $sender->despawnFromAll();
            $sender->spawnToAll();
        });
    }*/
}
