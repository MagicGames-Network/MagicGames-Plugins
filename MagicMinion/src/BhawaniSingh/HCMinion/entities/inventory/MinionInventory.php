<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\inventory;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\inventory\SimpleInventory;

class MinionInventory extends SimpleInventory
{
    public function getName(): string
    {
        return 'MinionInventory';
    }

    public function reorder(): void
    {
        $this->setContents(
            array_map(
                [self::class, "realItem"],
                array_values($this->getContents())
            )
        );
    }

    private static function realItem(?Item $item): Item
    {
        return $item ?? VanillaItems::AIR();
    }

    public function setSize(int $size): void
    {
        $this->slots->setSize($size);
    }
}
