<?php

namespace BlankFix;

use pocketmine\world\World;
use pocketmine\event\Listener;
use BlankFix\player\MagicPlayer;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerCreationEvent;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerCreation(PlayerCreationEvent $event): void
    {
        $event->setPlayerClass(MagicPlayer::class);
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $defaultWorld = $this->getServer()->getWorldManager()->getDefaultWorld();
        if (!$defaultWorld instanceof World) {
            return;
        }

        $event->getPlayer()->teleport($defaultWorld->getSpawnLocation());
    }
}
