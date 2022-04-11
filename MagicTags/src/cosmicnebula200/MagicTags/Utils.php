<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags;

use pocketmine\player\Player as P;

class Utils
{

    public static function checkTag(string $tag): bool
    {
        $tags = MagicTags::getInstance()->getTags();
        if (isset($tag, $tags))
            return true;
        return false;
    }

    public static function hasTag(P $player, string $tag): bool
    {
        if (in_array($tag, MagicTags::getInstance()->getPlayerManager()->getPlayer($player)->getTags()))
            Return true;
        return false;
    }

    public static function getTagName(string $name): string
    {
        $tags = MagicTags::getInstance()->getTags();
        if ($name == "")
            return "[]";
        $name = str_replace([" ", ","] , ["",""], $name);
        return $tags[$name]["Name"];
    }

}
