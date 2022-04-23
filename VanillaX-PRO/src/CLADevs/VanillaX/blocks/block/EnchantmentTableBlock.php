<?php

namespace CLADevs\VanillaX\blocks\block;

use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\block\Transparent;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\tile\EnchantTable;
use CLADevs\VanillaX\inventories\types\EnchantInventory;

class EnchantmentTableBlock extends Transparent
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::ENCHANTING_TABLE, 0, null, EnchantTable::class), "Enchanting Table", new BlockBreakInfo(5, BlockToolType::PICKAXE, 0, 1200));
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null): bool
    {
        $player?->setCurrentWindow(new EnchantInventory($this->getPosition()));
        return true;
    }
}
