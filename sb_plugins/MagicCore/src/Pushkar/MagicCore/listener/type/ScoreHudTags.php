<?php

namespace Pushkar\MagicCore\listener\type;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use Ifera\ScoreHud\event\TagsResolveEvent;
use Ifera\ScoreHud\event\PlayerTagUpdateEvent;

class ScoreHudTags implements Listener
{
    public static function onTagResolve(TagsResolveEvent $event): void
    {
        $tag = $event->getTag();

        switch ($tag->getName()) {
            case "bits.magiccore":
                $tag->setValue(strval("0"));
                break;
        }
    }
}
