<?php

namespace HubSpawn;

use pocketmine\world\World;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
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
