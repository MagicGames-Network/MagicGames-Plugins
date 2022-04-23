<?php

namespace CLADevs\VanillaX\items\types\netherite;

use pocketmine\item\Axe;
use pocketmine\item\ToolTier;
use pocketmine\item\ItemIdentifier;
use CLADevs\VanillaX\items\LegacyItemIds;
use CLADevs\VanillaX\items\utils\RecipeItemTrait;

class NetheriteAxe extends Axe
{
    use RecipeItemTrait;

    //Netherite Tier isnt a thing
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(LegacyItemIds::NETHERITE_AXE, 0), "Netherite Axe", ToolTier::DIAMOND());
    }

    public function getAttackPoints(): int
    {
        return 8; //Netherite Axe Damage
    }

    public function getMaxDurability(): int
    {
        return 2031;
    }

    protected function getBaseMiningEfficiency(): float
    {
        return 9;
    }
}
