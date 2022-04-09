<?php

namespace Stats;

use pocketmine\scheduler\Task;

class Tick extends Task{
    public function onRun(): void
    {
        foreach(Main::getInstance()->getServer()->getOnlinePlayers() as $player)
        {
            if(!$player instanceof Segundo) return;
            $item = $player->getInventory()->getItemInHand();
            $damage     = $player->getDamage() + $item->getAttackPoints();
            $defense    = $player->getDefense() + $player->getArmorPoints();
            $heal       = $player->getHealth();
            $maxheal    = $player->getMaxHealth();
            if($heal > $maxheal){
                $player->setHealth($maxheal);
            }
            $player->sendActionbarMessage("§cHealth: $heal"."§7/§c$maxheal  §aDefense: §a$defense \n§4Damage: $damage  §bMana: 100 ");
        }
    }
}
