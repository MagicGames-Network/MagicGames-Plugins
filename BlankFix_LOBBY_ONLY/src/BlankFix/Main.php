<?php

namespace BlankFix;

use pocketmine\event\Listener;
use BlankFix\player\MagicPlayer;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerCreationEvent;

class Main extends PluginBase implements Listener
{
    public function onPlayerCreation(PlayerCreationEvent $event): void
    {
        $event->setPlayerClass(MagicPlayer::class);
    }
}
