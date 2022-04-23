<?php

namespace CLADevs\VanillaX\blocks\block\ore;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\ToolTier;
use pocketmine\item\ItemFactory;
use pocketmine\block\RedstoneOre;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\block\BlockIdentifierFlattened;

class RedstoneOreBlock extends RedstoneOre
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifierFlattened(BlockLegacyIds::REDSTONE_ORE, [BlockLegacyIds::LIT_REDSTONE_ORE], 0), "Redstone Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel()));
    }

    /**
     * @param Item $item
     * @return Item[]
     */
    public function getDropsForCompatibleTool(Item $item): array
    {
        return [ItemFactory::getInstance()->get(ItemIds::REDSTONE_DUST, 0, min(8, mt_rand(4, 5) + $item->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE))))];
    }
}
