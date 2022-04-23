<?php

namespace CLADevs\VanillaX\blocks\block\ore;

use pocketmine\item\Item;
use pocketmine\block\Opaque;
use pocketmine\item\ItemIds;
use pocketmine\item\ToolTier;
use pocketmine\item\ItemFactory;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockIdentifier;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\data\bedrock\EnchantmentIdMap;

class GoldOreBlock extends Opaque
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::GOLD_ORE, 0), "Gold Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel()));
    }

    /**
     * @param Item $item
     * @return Item[]
     */
    public function getDropsForCompatibleTool(Item $item): array
    {
        return [ItemFactory::getInstance()->get(ItemIds::GOLD_ORE, 0, 1 + mt_rand(0, $item->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE))))];
    }
}
