<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\types;

use pocketmine\block\Air;
use pocketmine\block\Crops;
use pocketmine\block\Farmland;
use pocketmine\item\ItemFactory;
use pocketmine\block\VanillaBlocks;
use BhawaniSingh\HCMinion\entities\MinionEntity;
use pocketmine\world\particle\BlockBreakParticle;

class FarmingMinion extends MinionEntity
{
    public function getTarget(): void
    {
        $blocks = [];
        for ($x = -$this->getMinionRange(); $x <= $this->getMinionRange(); ++$x) {
            for ($z = -$this->getMinionRange(); $z <= $this->getMinionRange(); ++$z) {
                if ($x === 0 && $z === 0) {
                    continue;
                }

                $block = $this->getWorld()->getBlock($this->getPosition()->add($x, 0, $z));
                if ($block instanceof Air || ($block->getId() === $this->getMinionInformation()->getType()->getTargetId() && $block->getMeta() === $this->getMinionInformation()->getType()->getTargetMeta())) {
                    $blocks[] = $block;
                }
            }
        }
        if (count($blocks) > 0) {
            $this->target = $blocks[array_rand($blocks)];
            return;
        }
        $this->stopWorking();
    }

    public function startWorking(): void
    {
        if (!$this->target instanceof Crops) {
            $farmland = $this->getWorld()->getBlock($this->target->getPosition()->add(0, -1, 0));
            if (!$farmland instanceof Farmland) {
                $this->getWorld()->setBlock($farmland->getPosition(), VanillaBlocks::FARMLAND());
                return;
            }
            if ($this->target instanceof Air) {
                $this->getWorld()->setBlock($this->target->getPosition(), $this->getMinionInformation()->getType()->toBlock());
            }
        } elseif ($this->target->getAge() === 7) {
            $this->getWorld()->addParticle($this->target->getPosition()->add(0.5, 0.5, 0.5), new BlockBreakParticle($this->target));
            $this->getWorld()->setBlock($this->target->getPosition(), VanillaBlocks::AIR());

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
        } else {
            $this->target->setAge($this->target->getAge() + 1);
        }
    }

    public function broadcastPlaceBreak(): bool
    {
        return false;
    }

    public function isWorkFast(): bool
    {
        return true;
    }
}
