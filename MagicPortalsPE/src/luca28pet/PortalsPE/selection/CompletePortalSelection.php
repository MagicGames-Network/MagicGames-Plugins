<?php

declare(strict_types=1);

namespace luca28pet\PortalsPE\selection;

use function max;
use function min;
use pocketmine\math\Vector3;
use pocketmine\world\Position;
use pocketmine\math\AxisAlignedBB;

class CompletePortalSelection
{
    protected Vector3 $firstBlock;
    protected Vector3 $secondBlock;
    private string $selectionFolderName;

    public function __construct(Vector3 $firstBlock, Vector3 $secondBlock, string $selectionFolderName)
    {
        $this->firstBlock = $firstBlock;
        $this->secondBlock = $secondBlock;
        $this->selectionFolderName = $selectionFolderName;
    }

    public function getFirstBlock(): Vector3
    {
        return $this->firstBlock;
    }

    public function setFirstBlock(Vector3 $firstBlock): void
    {
        $this->firstBlock = $firstBlock;
    }

    public function getSecondBlock(): Vector3
    {
        return $this->secondBlock;
    }

    public function setSecondBlock(Vector3 $secondBlock): void
    {
        $this->secondBlock = $secondBlock;
    }

    public function getSelectionFolderName(): string
    {
        return $this->selectionFolderName;
    }

    public function setSelectionFolderName(string $selectionFolderName): void
    {
        $this->selectionFolderName = $selectionFolderName;
    }

    public function isInside(Position $position): bool
    {
        $position = Position::fromObject($position->floor(), $position->getWorld());
        $aabb = new AxisAlignedBB($this->firstBlock->x, $this->firstBlock->y, $this->firstBlock->z, $this->secondBlock->x, $this->secondBlock->y, $this->secondBlock->z);

        return $aabb->isVectorInXZ($position);
    }

    public function toArray(): array
    {
        return [
            'firstBlock' => ['x' => $this->firstBlock->x, 'y' => $this->firstBlock->y, 'z' => $this->firstBlock->z],
            'secondBlock' => ['x' => $this->secondBlock->x, 'y' => $this->secondBlock->y, 'z' => $this->secondBlock->z],
            'folderName' => $this->selectionFolderName
        ];
    }

    public static function fromArray(array $array): CompletePortalSelection
    {
        return new CompletePortalSelection(
            new Vector3($array['firstBlock']['x'], $array['firstBlock']['y'], $array['firstBlock']['z']),
            new Vector3($array['secondBlock']['x'], $array['secondBlock']['y'], $array['secondBlock']['z']),
            $array['folderName']
        );
    }
}
