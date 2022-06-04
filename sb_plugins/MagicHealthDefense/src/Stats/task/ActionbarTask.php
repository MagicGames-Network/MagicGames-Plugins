<?php

namespace Stats\task;

use Stats\Main;
use Stats\player\MagicPlayer;
use pocketmine\scheduler\Task;

class ActionbarTask extends Task
{
    public function onRun(): void
    {
        foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $player) {
            if ($player instanceof MagicPlayer) {
                $heal = $player->getHealth();
                $maxHealth = $player->getMaxHealth();
                if ($heal > $maxHealth) {
                    $player->setHealth($maxHealth);
                }
                $item = $player->getInventory()->getItemInHand();
                $damage = $player->getDamage() + $item->getAttackPoints();
                $defense = $player->getDefense() + $player->getArmorPoints();
                $food = $player->getHungerManager()->getFood();
                $maxFood = $player->getHungerManager()->getMaxFood();
                $healthPercentage = ($heal / $maxHealth) * 100;
                $healthBar = match ((int) $healthPercentage) {
                    1 => "",
                    2 => "",
                    3 => "",
                    4 => "",
                    5 => "",
                    6 => "",
                    7 => "",
                    8 => "",
                    9 => "",
                    10 => "",
                    11 => "",
                    12 => "",
                    13 => "",
                    14 => "",
                    15 => "",
                    16 => "",
                    17 => "",
                    18 => "",
                    19 => "",
                    20 => "",
                    21 => "",
                    22 => "",
                    23 => "",
                    24 => "",
                    25 => "",
                    26 => "",
                    27 => "",
                    28 => "",
                    29 => "",
                    30 => "",
                    31 => "",
                    32 => "",
                    33 => "",
                    34 => "",
                    35 => "",
                    36 => "",
                    37 => "",
                    38 => "",
                    39 => "",
                    40 => "",
                    41 => "",
                    default => ""
                };
                $foodPercentage = ($food / $maxFood) * 100;
                $foodBar = match ((int) $foodPercentage) {
                    1 => "",
                    2 => "",
                    3 => "",
                    4 => "",
                    5 => "",
                    6 => "",
                    7 => "",
                    8 => "",
                    9 => "",
                    10 => "",
                    11 => "",
                    12 => "",
                    13 => "",
                    14 => "",
                    15 => "",
                    16 => "",
                    17 => "",
                    18 => "",
                    19 => "",
                    20 => "",
                    21 => "",
                    22 => "",
                    23 => "",
                    24 => "",
                    25 => "",
                    26 => "",
                    27 => "",
                    28 => "",
                    29 => "",
                    30 => "",
                    31 => "",
                    32 => "",
                    33 => "",
                    34 => "",
                    35 => "",
                    36 => "",
                    37 => "",
                    38 => "",
                    39 => "",
                    40 => "",
                    41 => "",
                    default => ""
                };
                $player->sendActionBarMessage("§a$defense    §4$damage \n§c$heal / $maxHealth §7Health           Food§6 $food / $maxFood\n$healthBar     $foodBar");
            }
        }
    }
}
