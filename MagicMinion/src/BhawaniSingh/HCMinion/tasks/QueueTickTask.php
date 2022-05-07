<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\tasks;

use pocketmine\Server;
use pocketmine\block\Air;
use pocketmine\world\World;
use pocketmine\scheduler\Task;
use pocketmine\world\format\Chunk;
use BhawaniSingh\HCMinion\BetterMinion;
use BhawaniSingh\HCMinion\entities\MinionEntity;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;

class QueueTickTask extends Task
{
    public function onRun(): void
    {
        $i = 0;
        foreach (BetterMinion::$minionQueue as $iterationQueue => $entityData) {
            if ($i > BetterMinion::QUEUE_CYCLE) {
                break;
            }

            $world = Server::getInstance()->getWorldManager()->getWorld($entityData["worldId"]);
            if (!$world instanceof World) {
                unset(BetterMinion::$minionQueue[$iterationQueue]);
                continue;
            }

            $entity = $world->getEntity($entityData["entityId"]);
            if ($entity instanceof MinionEntity && !$entity->isClosed() && !$entity->isFlaggedForDespawn() && !$entity->isViewingInv) {
                if ($entity->ticksLived % 60 === 0) {
                    $entity->updateTarget();
                }
                if (!$entity->checkFull()) {
                    unset(BetterMinion::$minionQueue[$iterationQueue]);
                    $entity->isQueued = false;
                    $i++;
                    continue;
                }

                if (!$entity->isWorking) {
                    $entity->getTarget();
                    $entity->isWorking = true;
                }

                $world->requestChunkPopulation($entity->target->getPosition()->getX() >> Chunk::COORD_BIT_SIZE, $entity->target->getPosition()->getZ() >> Chunk::COORD_BIT_SIZE, null);
                if (!$entity->checkTarget()) {
                    $entity->stopWorking();

                    unset(BetterMinion::$minionQueue[$iterationQueue]);
                    $entity->isQueued = false;
                    $i++;
                    continue;
                }

                $entity->setNameTag("§l§6" . strtoupper($entity->getMinionInformation()->getType()->getTargetName()) . "§r\n§e" . $entity->getMinionInformation()->getOwner() . "'s Minion");
                $entity->setNameTagAlwaysVisible(false);
                switch ($entity->currentAction) {
                    case MinionEntity::ACTION_IDLE:
                        $entity->currentAction = MinionEntity::ACTION_TURNING;
                        break;
                    case MinionEntity::ACTION_TURNING:
                        $entity->lookAt($entity->target->getPosition());
                        $entity->currentAction = MinionEntity::ACTION_WORKING;
                        break;
                    case MinionEntity::ACTION_WORKING:
                        $isPlacing = $entity->target instanceof Air;
                        if (!$isPlacing) {
                            if ($entity->broadcastPlaceBreak()) {
                                $world->broadcastPacketToViewers($entity->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_START_BREAK, (int) (65535 / 60), $entity->target->getPosition()));
                            }
                            if ($entity->isWorkFast()) {
                                $entity->startWorking();
                            }
                            $pk = new AnimatePacket();
                            $pk->action = AnimatePacket::ACTION_SWING_ARM;
                            $pk->actorRuntimeId = $entityData["entityId"];
                            if ($entity->broadcastPlaceBreak()) {
                                $world->broadcastPacketToViewers($entity->getPosition(), $pk);
                            }
                        } elseif ($entity->broadcastPlaceBreak()) {
                            $world->broadcastPacketToViewers($entity->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $entity->target->getPosition()));
                        }
                        $entity->startWorking();
                        $entity->stopWorking();
                        if (!$entity->checkFull()) {
                            unset(BetterMinion::$minionQueue[$iterationQueue]);
                            $entity->isQueued = false;
                            $i++;
                            continue 2;
                        }
                        break;
                    case MinionEntity::ACTION_CANT_WORK:
                        if (!$entity->isInventoryFull()) {
                            $entity->currentAction = MinionEntity::ACTION_IDLE;
                        }
                        break;
                }
                $entity->isQueued = false;
                $i++;
            }
            unset(BetterMinion::$minionQueue[$iterationQueue]);
        }
    }
}
