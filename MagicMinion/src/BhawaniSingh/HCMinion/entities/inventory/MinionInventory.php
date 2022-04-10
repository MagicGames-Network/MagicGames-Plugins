<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\inventory;

use pocketmine\inventory\BaseInventory;

class MinionInventory extends BaseInventory
{
    public function getName(): string
    {
        return 'MinionInventory';
    }

    public function getDefaultSize(): int
    {
        return 15;
    }
}
