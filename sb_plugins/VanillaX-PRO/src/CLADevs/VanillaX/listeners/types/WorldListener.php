<?php

namespace CLADevs\VanillaX\listeners\types;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use AGTHARN\MagicSync\MagicSync;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\world\WorldLoadEvent;
use pocketmine\event\world\WorldUnloadEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use CLADevs\VanillaX\world\weather\WeatherManager;
use CLADevs\VanillaX\world\gamerule\GameRuleManager;

class WorldListener implements Listener
{

    public function onLevelLoad(WorldLoadEvent $event): void
    {
        WeatherManager::getInstance()->addWeather($event->getWorld());
    }

    public function onLevelUnload(WorldUnloadEvent $event): void
    {
        if (!$event->isCancelled()) {
            WeatherManager::getInstance()->removeWeather($event->getWorld());
        }
    }

    public function onLevelChange(EntityTeleportEvent $event): void
    {
        MagicSync::getInstance()->addEntityTeleport($event->getEntity(), new ClosureTask(function () use ($event): void {
            $from = $event->getFrom();
            $to = $event->getTo();

            if (!$event->isCancelled() && $from->getWorld()->getFolderName() !== $to->getWorld()->getFolderName()) {
                $entity = $event->getEntity();
                $weather = WeatherManager::getInstance();
                $previousWeather = $weather->getWeather($from->getWorld());
                $targetWeather = $weather->getWeather($to->getWorld());

                if ($entity instanceof Player) {
                    GameRuleManager::getInstance()->sendChanges($entity, $to->getWorld());
                    if ($previousWeather !== null && $targetWeather !== null && $previousWeather->isRaining() && !$targetWeather->isRaining()) {
                        $weather->sendClear($entity);
                    }
                }
            }
        }), "CHECKING GAMERULES AND WEATHER");
    }
}
