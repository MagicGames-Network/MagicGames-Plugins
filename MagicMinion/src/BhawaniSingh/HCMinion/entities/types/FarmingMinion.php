<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\types;

use BhawaniSingh\HCMinion\entities\MinionEntity;
use BhawaniSingh\HCMinion\entities\objects\Farmland;
use pocketmine\block\Block;
use pocketmine\block\BlockIds;
use pocketmine\block\Crops;
use pocketmine\item\Item;
use function array_rand;
use function count;
use function in_array;
use function mt_rand;

class FarmingMinion extends MinionEntity
{
    protected function updateTarget(): void
    {
        for ($x = -$this->getMinionRange(); $x <= $this->getMinionRange(); ++$x) {
            for ($z = -$this->getMinionRange(); $z <= $this->getMinionRange(); ++$z) {
                if ($x === 0 && $z === 0) {
                    continue;
                }
                if (mt_rand(0, 2) === 0) {
                    $block = $this->level->getBlock($this->add($x, 0, $z));
                    if ($block instanceof Crops || $block->getId() === BlockIds::NETHER_WART_PLANT) {
                        $max = $block instanceof Crops ? 7 : 3;
                        $block->setDamage($block->getDamage() + 1 < $max ? $block->getDamage() + 1 : $max);
                        $this->level->setBlock($block, $block);
                    }
                }
            }
        }
    }

    protected function isWorkFast(): bool
    {
        return true;
    }

    protected function getTool(string $tool, bool $isNetheriteTool): Item
    {
        return $isNetheriteTool ? Item::get(747) : Item::fromString($tool . ' Hoe');
    }

    protected function getTarget(): void
    {
        $blocks = [];
        for ($x = -$this->getMinionRange(); $x <= $this->getMinionRange(); ++$x) {
            for ($z = -$this->getMinionRange(); $z <= $this->getMinionRange(); ++$z) {
                if ($x === 0 && $z === 0) {
                    continue;
                }
                $farmland = $this->level->getBlock($this->add($x, -1, $z));
                $block = $this->level->getBlock($this->add($x, 0, $z));
                if ($block->getId() === BlockIds::AIR || ($block->getId() === $this->getMinionInformation()->getType()->getTargetId() && $block->getDamage() >= ($block instanceof Crops ? 7 : 3) && $this->isFarmland($farmland))) {
                    $blocks[] = $block;
                }
            }
        }
        if (count($blocks) > 0) {
            $this->target = $blocks[array_rand($blocks)];
        }
    }

    protected function checkTarget(): bool
    {
        return ($this->target->getId() !== BlockIds::AIR && $this->isFarmland($this->level->getBlock($this->target->subtract(0, 1)))) || parent::checkTarget();
    }

    protected function startWorking(): void
    {
        $farmland = $this->level->getBlock($this->target->subtract(0, 1));
        if (!$this->isFarmland($farmland)) {
            if ($this->getMinionInformation()->getType()->getTargetId() !== BlockIds::NETHER_WART_PLANT && in_array($farmland->getId(), [BlockIds::GRASS, BlockIds::DIRT], true)) {
                $this->level->setBlock($farmland, new Farmland(7, true));
            }
            if ($farmland->getId() === BlockIds::AIR && $this->getMinionInformation()->getType()->getTargetId() === BlockIds::NETHER_WART_PLANT) {
                $this->level->setBlock($farmland, Block::get(BlockIds::SOUL_SAND));
            }
        }
        parent::startWorking();
    }

    private function isFarmland(Block $block): bool
    {
        return $block->getId() === ($this->getMinionInformation()->getType()->getTargetId() === BlockIds::NETHER_WART_PLANT ? BlockIds::SOUL_SAND : BlockIds::FARMLAND);
    }
}
