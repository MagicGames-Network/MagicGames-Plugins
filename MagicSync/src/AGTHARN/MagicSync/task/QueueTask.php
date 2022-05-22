<?php

namespace AGTHARN\MagicSync\task;

use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use AGTHARN\MagicSync\MagicSync;
use pocketmine\scheduler\ClosureTask;

class QueueTask extends Task
{
    public function onRun(): void
    {
        foreach (MagicSync::getInstance()->joinQueue as $queueNumber => $queueData) {
            $player = Server::getInstance()->getPlayerExact($queueData[0]);
            if ($player instanceof Player && $player->isConnected()) {
                foreach ($queueData[1] as $data) {
                    $player->sendTitle("§l§aSYNCING", "§l§8" . $data[1]);
    
                    /** @var ClosureTask $closureTask */
                    $closureTask = $data[0];
                    $closureTask->onRun();
                }

                $player->setImmobile(false);
            }
            unset(MagicSync::getInstance()->playersJoined[$queueData[0]]);
            unset(MagicSync::getInstance()->joinQueue[$queueNumber]);
            return;
        }

        foreach (MagicSync::getInstance()->teleportQueue as $queueNumber => $queueData) {
            $entity = Server::getInstance()->getWorldManager()->getWorld($queueData[1])?->getEntity($queueData[0]) ?? null;
            if (!$entity instanceof Entity) {
                unset(MagicSync::getInstance()->entitiesTeleporting[$queueData[0]]);
                unset(MagicSync::getInstance()->teleportQueue[$queueNumber]);
                return;
            }

            foreach ($queueData[2] as $data) {
                if ($entity instanceof Player) {
                    $entity->sendTitle("§l§aSYNCING", "§l§8" . $data[1]);
                }

                /** @var ClosureTask $closureTask */
                $closureTask = $data[0];
                $closureTask->onRun();
            }

            $entity->setImmobile(false);
            
            unset(MagicSync::getInstance()->entitiesTeleporting[$queueData[0]]);
            unset(MagicSync::getInstance()->teleportQueue[$queueNumber]);
            return;
        }
    }
}
