<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags\listeners\types;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;

class TagChangeEvent extends PlayerEvent implements Cancellable
{

    /**@var string*/
    private string $old_tag;
    /**@var string*/
    private string $tag;
    /**@var bool */
    private bool $canceled = false;

    public function __construct(string $old_tag, string $tag)
    {
        $this->old_tag = $old_tag;
        $this->tag = $tag;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getOldTag(): string
    {
        return $this->old_tag;
    }

    public function cancel(): void
    {
        $this->canceled = true;
    }

    public function isCancelled(): bool
    {
        return $this->canceled;
    }
}
