<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities\objects;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIds;
use pocketmine\level\ChunkManager;
use pocketmine\level\generator\object\Tree;
use pocketmine\utils\Random;

class MinionTree extends Tree
{
    /** @var Block */
    public $sapling;

    public function __construct(Block $log)
    {
        $this->trunkBlock = $log->getId();
        $this->leafBlock = $log->getId() === BlockIds::WOOD ? BlockIds::LEAVES : BlockIds::LEAVES2;
        $this->type = $log->getVariant();
        $this->sapling = Block::get(BlockIds::SAPLING, $log->getId() === BlockIds::WOOD ? $log->getVariant() : ($log->getVariant() + 4));
    }

    public function placeObject(ChunkManager $level, int $x, int $y, int $z, Random $random): void
    {
        parent::placeTrunk($level, $x, $y, $z, $random, 4);
        if (!BlockFactory::$solid[$level->getBlockIdAt($x, $y + 4, $z)]) {
            $level->setBlockIdAt($x, $y + 4, $z, $this->leafBlock);
            $level->setBlockDataAt($x, $y + 4, $z, $this->type);
        }
        $yy = $y + 3;
        for ($xx = $x - 1; $xx <= $x + 1; ++$xx) {
            for ($zz = $z - 1; $zz <= $z + 1; ++$zz) {
                if (!BlockFactory::$solid[$level->getBlockIdAt($xx, $yy, $zz)]) {
                    $level->setBlockIdAt($xx, $yy, $zz, $this->leafBlock);
                    $level->setBlockDataAt($xx, $yy, $zz, $this->type);
                }
            }
        }
    }
}
