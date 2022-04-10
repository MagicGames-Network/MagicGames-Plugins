<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\types;

use BhawaniSingh\HCMinion\entities\MinionEntity;
use pocketmine\block\BlockIds;
use pocketmine\block\BlockToolType;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use function array_rand;
use function count;

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
                $block = $this->level->getBlock($this->add($x, -1, $z));
                if ($block->getId() === BlockIds::AIR || ($block->getId() === $this->getMinionInformation()->getType()->getTargetId() && $block->getDamage() === $this->getMinionInformation()->getType()->getTargetMeta())) {
                    $blocks[] = $block;
                }
            }
        }
        if (count($blocks) > 0) {
            $this->target = $blocks[array_rand($blocks)];
        }
    }

    protected function getTool(string $tool, bool $isNetheriteTool): Item
    {
        $tools = [
            BlockToolType::TYPE_NONE => $isNetheriteTool ? Item::get(745) : Item::fromString($tool . ' Pickaxe'),
            BlockToolType::TYPE_SHOVEL => $isNetheriteTool ? Item::get(744) : Item::fromString($tool . ' Shovel'),
            BlockToolType::TYPE_PICKAXE => $isNetheriteTool ? Item::get(745) : Item::fromString($tool . ' Pickaxe'),
            BlockToolType::TYPE_AXE => $isNetheriteTool ? Item::get(746) : Item::fromString($tool . ' Axe'),
            BlockToolType::TYPE_SHEARS => Item::get(ItemIds::SHEARS),
        ];

        return $tools[$this->getMinionInformation()->getType()->toBlock()->getToolType()];
    }
}
