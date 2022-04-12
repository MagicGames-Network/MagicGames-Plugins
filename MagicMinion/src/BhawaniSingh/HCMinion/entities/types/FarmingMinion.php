<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\types;

use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\block\Crops;
use pocketmine\math\Facing;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemFactory;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\StringToItemParser;
use BhawaniSingh\HCMinion\entities\MinionEntity;
use pocketmine\world\particle\BlockBreakParticle;

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
                    $block = $this->getWorld()->getBlock($this->getPosition()->add($x, 0, $z));
                    if ($block instanceof Crops) {
                        $block->setAge($block->getAge() + 3 < 7 ? $block->getAge() + 3 : 7);
                    }
                }
            }
        }
    }

    protected function getTarget(): void
    {
        $blocks = [];
        for ($x = -$this->getMinionRange(); $x <= $this->getMinionRange(); ++$x) {
            for ($z = -$this->getMinionRange(); $z <= $this->getMinionRange(); ++$z) {
                if ($x === 0 && $z === 0) {
                    continue;
                }
                $farmland = $this->getWorld()->getBlock($this->getPosition()->add($x, -1, $z));
                $block = $this->getWorld()->getBlock($this->getPosition()->add($x, 0, $z));
                if (!$block instanceof Crops) {
                    continue;
                }

                if ($block->getId() === $this->getMinionInformation()->getType()->getTargetId() && $block->getMeta() === $this->getMinionInformation()->getType()->getTargetMeta() && $block->getAge() >= 7 && $this->isFarmland($farmland)) {
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
        return ($this->target->getId() !== BlockLegacyIds::AIR && $this->isFarmland($this->getWorld()->getBlock($this->target->getPosition()->getSide(Facing::DOWN)))) || parent::checkTarget();
    }

    protected function startWorking(): void
    {
        $farmland = $this->getWorld()->getBlock($this->target->getPosition()->getSide(Facing::DOWN));
        if (!$this->isFarmland($farmland)) {
            if (in_array($farmland->getId(), [BlockLegacyIds::GRASS, BlockLegacyIds::DIRT], true)) {
                $this->getWorld()->setBlock($farmland->getPosition(), VanillaBlocks::FARMLAND());
            }
        }

        $this->getWorld()->addParticle($this->target->getPosition()->add(0.5, 0.5, 0.5), new BlockBreakParticle($this->target));
        $this->getWorld()->setBlock($this->target->getPosition(), $this->target->getId() === BlockLegacyIds::AIR ? $this->getMinionInformation()->getType()->toBlock() : VanillaBlocks::AIR());
        if ($this->target->getId() !== BlockLegacyIds::AIR && $this->target instanceof Crops && $this->target->getAge() === 7) {
            $drops = $this->getTargetDrops();
            foreach ($drops as $drop) {
                for ($i = 1; $i <= $drop->getCount(); ++$i) {
                    $thing = ItemFactory::getInstance()->get($drop->getId(), $drop->getMeta());
                    if ($this->getMinionInventory()->canAddItem($thing)) {
                        $this->getMinionInventory()->addItem($thing);
                        $this->getMinionInformation()->incrementResourcesCollected();
                    }
                }
            }
        }
    }

    private function isFarmland(Block $block): bool
    {
        return $block->getId() === ItemIds::FARMLAND;
    }

    protected function getTool(string $tool, bool $isNetheriteTool): ?Item
    {
        return $isNetheriteTool ? ItemFactory::getInstance()->get(747) : StringToItemParser::getInstance()->parse($tool . ' Hoe');
    }

    protected function isWorkFast(): bool
    {
        return true;
    }
}
