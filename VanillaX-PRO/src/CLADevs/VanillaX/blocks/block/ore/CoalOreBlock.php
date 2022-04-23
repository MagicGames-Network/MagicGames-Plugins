<?php

namespace CLADevs\VanillaX\blocks\block\ore;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\block\CoalOre;
use pocketmine\item\ToolTier;
use pocketmine\item\ItemFactory;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockIdentifier;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\data\bedrock\EnchantmentIdMap;

class CoalOreBlock extends CoalOre
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::COAL_ORE, 0), "Coal Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()));
    }

    /**
     * @param Item $item
     * @return Item[]
     */
    public function getDropsForCompatibleTool(Item $item): array
    {
        return [ItemFactory::getInstance()->get(ItemIds::COAL, 0, 1 + mt_rand(0, $item->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE))))];
    }
}
