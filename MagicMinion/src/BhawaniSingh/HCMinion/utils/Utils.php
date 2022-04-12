<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\utils;

use pocketmine\math\Vector3;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\CompoundTag;

class Utils
{
    public static function getRomanNumeral(int $integer): string
    {
        $romanNumeralConversionTable = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        ];
        $romanString = '';
        while ($integer > 0) {
            foreach ($romanNumeralConversionTable as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $romanString .= $rom;

                    break;
                }
            }
        }

        return $romanString;
    }

    public static function createBaseNBT(Vector3 $pos, ?Vector3 $motion = null, float $yaw = 0.0, float $pitch = 0.0): CompoundTag
    {
        return CompoundTag::create()
            ->setTag('Pos', new ListTag([
                new DoubleTag($pos->x),
                new DoubleTag($pos->y),
                new DoubleTag($pos->z)
            ]))
            ->setTag('Motion', new ListTag([
                new DoubleTag($motion !== null ? $motion->x : 0.0),
                new DoubleTag($motion !== null ? $motion->y : 0.0),
                new DoubleTag($motion !== null ? $motion->z : 0.0)
            ]))
            ->setTag('Rotation', new ListTag([
                new FloatTag($yaw),
                new FloatTag($pitch)
            ]));
    }
}
