<?php

namespace Heisenburger69\BurgerSpawners\entities;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\CompoundTag;

class SpawnerEntity extends Living
{
    public CompoundTag $namedTag;

    public int $stack = 0;

    public function __construct(Location $location, ?CompoundTag $nbt = null)
    {
        if ($nbt === null) {
            $nbt = new CompoundTag();
        }
        $this->namedTag = $nbt;
        parent::__construct($location, $nbt);
    }

    public function getNamedTag(): CompoundTag
    {
        return $this->namedTag;
    }

    protected function getInitialSizeInfo(): EntitySizeInfo
    {
        return new EntitySizeInfo(1.8, 1);
    }

    public static function getNetworkTypeId(): string
    {
        return "cosmicspawner:default";
    }

    public function getName(): string
    {
        return "CosmicMob";
    }
}
