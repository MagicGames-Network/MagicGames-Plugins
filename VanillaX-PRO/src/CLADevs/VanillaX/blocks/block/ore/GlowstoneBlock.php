<?php

namespace CLADevs\VanillaX\blocks\block\ore;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\block\Glowstone;
use pocketmine\item\ItemFactory;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockIdentifier;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\data\bedrock\EnchantmentIdMap;

class GlowstoneBlock extends Glowstone
{

    public function __construct()
    {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::GLOWSTONE, 0), "Glowstone", new BlockBreakInfo(0.3, BlockToolType::PICKAXE));
    }

    /**
     * @param Item $item
     * @return Item[]
     */
    public function getDropsForCompatibleTool(Item $item): array
    {
        return [ItemFactory::getInstance()->get(ItemIds::GLOWSTONE_DUST, 0, min(4, mt_rand(2, 4) + mt_rand(0, $item->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE)))))];
    }
}
