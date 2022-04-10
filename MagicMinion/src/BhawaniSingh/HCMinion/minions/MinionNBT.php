<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\minions;

use pocketmine\nbt\tag\CompoundTag;

interface MinionNBT
{
    public function nbtSerialize(): CompoundTag;

    public static function nbtDeserialize(CompoundTag $tag);
}
