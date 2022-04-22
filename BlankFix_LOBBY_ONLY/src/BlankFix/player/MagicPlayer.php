<?php

namespace BlankFix\player;

use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MagicPlayer extends Player
{
    public function teleport(Vector3 $pos, ?float $yaw = 0.0, ?float $pitch = 0.0): bool
    {
        if (parent::teleport($pos, $yaw, $pitch)) {
            return true;
        }
        return false;
    }
}
