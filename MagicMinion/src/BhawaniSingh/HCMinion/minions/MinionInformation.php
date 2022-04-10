<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\minions;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;

class MinionInformation implements MinionNBT
{
    /** @var string */
    private $owner;
    /** @var MinionType */
    private $type;
    /** @var MinionUpgrade */
    private $upgrade;
    /** @var int */
    private $level;
    /** @var int */
    private $resourcesCollected;

    public function __construct(string $owner, MinionType $type, MinionUpgrade $upgrade, int $level, int $resourcesCollected)
    {
        $this->owner = $owner;
        $this->type = $type;
        $this->upgrade = $upgrade;
        $this->level = $level;
        $this->resourcesCollected = $resourcesCollected;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getType(): MinionType
    {
        return $this->type;
    }

    public function getUpgrade(): MinionUpgrade
    {
        return $this->upgrade;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function incrementLevel(): void
    {
        ++$this->level;
    }

    public function getResourcesCollected(): int
    {
        return $this->resourcesCollected;
    }

    public function incrementResourcesCollected(): void
    {
        ++$this->resourcesCollected;
    }

    public function nbtSerialize(): CompoundTag
    {
        return new CompoundTag('MinionInformation', [
            new StringTag('Owner', $this->getOwner()),
            $this->getType()->nbtSerialize(),
            $this->getUpgrade()->nbtSerialize(),
            new IntTag('Level', $this->getLevel()),
            new IntTag('ResourcesCollected', $this->getResourcesCollected()),
        ]);
    }

    public static function nbtDeserialize(CompoundTag $tag): self
    {
        return new self($tag->getString('Owner'), MinionType::nbtDeserialize($tag->getCompoundTag('MinionType')), MinionUpgrade::nbtDeserialize($tag->getCompoundTag('MinionUpgrade')), $tag->getInt('Level'), $tag->getInt('ResourcesCollected'));
    }
}
