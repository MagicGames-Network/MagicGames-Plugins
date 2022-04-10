<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\minions;

use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use function boolval;
use function intval;

class MinionUpgrade implements MinionNBT
{
    /** @var bool */
    private $autoSmelt;
    /** @var bool */
    private $autoSell;
    /** @var bool */
    private $compact;
    /** @var bool */
    private $expand;

    public function __construct(bool $autoSmelt = false, bool $autoSell = false, bool $compact = false, bool $expand = false)
    {
        $this->autoSmelt = $autoSmelt;
        $this->autoSell = $autoSell;
        $this->compact = $compact;
        $this->expand = $expand;
    }

    public function isAutoSmelt(): bool
    {
        return $this->autoSmelt;
    }

    public function setAutoSmelt(bool $autoSmelt = true): void
    {
        $this->autoSmelt = $autoSmelt;
    }

    public function isAutoSell(): bool
    {
        return $this->autoSell;
    }

    public function setAutoSell(bool $autoSell = true): void
    {
        $this->autoSell = $autoSell;
    }

    public function isCompact(): bool
    {
        return $this->compact;
    }

    public function setCompact(bool $compact = true): void
    {
        $this->compact = $compact;
    }

    public function isExpand(): bool
    {
        return $this->expand;
    }

    public function setExpand(bool $expand = true): void
    {
        $this->expand = $expand;
    }

    public function nbtSerialize(): CompoundTag
    {
        return new CompoundTag('MinionUpgrade', [
            new ByteTag('AutoSmelt', intval($this->isAutoSmelt())),
            new ByteTag('AutoSell', intval($this->isAutoSell())),
            new ByteTag('Compact', intval($this->isCompact())),
            new ByteTag('Expand', intval($this->isExpand())),
        ]);
    }

    public static function nbtDeserialize(CompoundTag $tag): self
    {
        return new self(boolval($tag->getByte('AutoSmelt')), boolval($tag->getByte('AutoSell')), boolval($tag->getByte('Compact')), boolval($tag->getByte('Expand')));
    }
}
