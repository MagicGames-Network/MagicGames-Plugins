<?php

namespace AGTHARN\MagicSync;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use AGTHARN\MagicSync\MagicSync;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class EventListener implements Listener
{
    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        
        $player->setImmobile();
        $player->sendTitle("§l§aSYNCING", "§l§8PLEASE WAIT!");
        MagicSync::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($player): void {
            if (isset(MagicSync::getInstance()->playersJoined[$player->getName()])) {
                MagicSync::getInstance()->joinQueue[MagicSync::getInstance()->queueNumber++] = [
                    $player->getName(),
                    MagicSync::getInstance()->playersJoined[$player->getName()]
                ];
            } else {
                $player->setImmobile(false);
            }
        }), 10);
    }

    public function onEntityTeleport(EntityTeleportEvent $event): void
    {
        $entity = $event->getEntity();
        
        $entity->setImmobile();
        if ($entity instanceof Player) {
            $entity->sendTitle("§l§aSYNCING", "§l§8PLEASE WAIT!");
        }

        MagicSync::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($entity): void {
            if (isset(MagicSync::getInstance()->entitiesTeleporting[$entity->getId()])) {
                MagicSync::getInstance()->teleportQueue[MagicSync::getInstance()->queueNumber++] = [
                    $entity->getId(),
                    $entity->getWorld()->getId(),
                    MagicSync::getInstance()->entitiesTeleporting[$entity->getId()]
                ];
            } else {
                $entity->setImmobile(false);
            }
        }), 10);
    }
    
    public function onBlockPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        if (isset($this->playersJoined[$player->getName()])) {
            $player->sendMessage(" §cYour data is still syncing, please wait!");
            $event->cancel();
        }
    }

    public function onBlockBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        if (isset($this->playersJoined[$player->getName()])) {
            $player->sendMessage(" §cYour data is still syncing, please wait!");
            $event->cancel();
        }
    }

    public function onPlayerCmd(PlayerCommandPreprocessEvent $event): void
    {
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        if (isset($this->playersJoined[$player->getName()]) && $msg[0] == "/") {
            $player->sendMessage(" §cYour data is still syncing, please wait!");
            $event->cancel();
        }
    }
}
