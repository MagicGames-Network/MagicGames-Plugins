<?php

namespace CLADevs\VanillaX\blocks\block\ore;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\ToolTier;
use pocketmine\block\LapisOre;
use pocketmine\item\ItemFactory;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockIdentifier;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\data\bedrock\EnchantmentIdMap;

class LapisOreBlock extends LapisOre
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::LAPIS_ORE, 0), "Lapis Lazuli Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel()));
    }

    /**
     * @param Item $item
     * @return Item[]
     */
    public function getDropsForCompatibleTool(Item $item): array
    {
        $fortune = $item->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE));
        return [ItemFactory::getInstance()->get(ItemIds::DYE, 4, $fortune >= 1 ? mt_rand(4, 9 * ($fortune + 1)) : mt_rand(4, 9))];
    }
}
