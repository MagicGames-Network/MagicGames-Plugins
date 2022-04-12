<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\types;

use function count;
use function array_rand;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemFactory;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\StringToItemParser;
use BhawaniSingh\HCMinion\entities\MinionEntity;

class MiningMinion extends MinionEntity
{
    protected function getTarget(): void
    {
        $blocks = [];
        for ($x = -$this->getMinionRange(); $x <= $this->getMinionRange(); ++$x) {
            for ($z = -$this->getMinionRange(); $z <= $this->getMinionRange(); ++$z) {
                if ($x === 0 && $z === 0) {
                    continue;
                }
                $block = $this->getWorld()->getBlock($this->getPosition()->add($x, -1, $z));
                if ($block->getId() === VanillaBlocks::AIR()->getId() || ($block->getId() === $this->getMinionInformation()->getType()->getTargetId() && $block->getMeta() === $this->getMinionInformation()->getType()->getTargetMeta())) {
                    $blocks[] = $block;
                }
            }
        }
        if (count($blocks) > 0) {
            $this->target = $blocks[array_rand($blocks)];
        }
    }

    protected function getTool(string $tool, bool $isNetheriteTool): ?Item
    {
        $tools = [
            BlockToolType::NONE => $isNetheriteTool ? ItemFactory::getInstance()->get(745) : StringToItemParser::getInstance()->parse($tool . ' Pickaxe'),
            BlockToolType::SHOVEL => $isNetheriteTool ? ItemFactory::getInstance()->get(744) : StringToItemParser::getInstance()->parse($tool . ' Shovel'),
            BlockToolType::PICKAXE => $isNetheriteTool ? ItemFactory::getInstance()->get(745) : StringToItemParser::getInstance()->parse($tool . ' Pickaxe'),
            BlockToolType::AXE => $isNetheriteTool ? ItemFactory::getInstance()->get(746) : StringToItemParser::getInstance()->parse($tool . ' Axe'),
            BlockToolType::SHEARS => ItemFactory::getInstance()->get(ItemIds::SHEARS),
        ];

        return $tools[$this->getMinionInformation()->getType()->toBlock()->getBreakInfo()->getToolType()];
    }
}
