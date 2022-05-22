<?php

namespace AGTHARN\MagicSync;

use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use AGTHARN\MagicSync\EventListener;
use AGTHARN\MagicSync\task\QueueTask;
use pocketmine\scheduler\ClosureTask;

class MagicSync extends PluginBase
{
    private static MagicSync $instance;

    public array $playersJoined = [];
    public array $entitiesTeleporting = [];

    public array $joinQueue = [];
    public array $teleportQueue = [];

    public int $queueNumber = 0;

    public static function getInstance(): MagicSync
    {
        return self::$instance;
    }

    public function onEnable(): void
    {
        self::$instance = $this;

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new QueueTask(), 5);
    }

    public function addPlayerJoin(Player $player, ClosureTask $closureTask, string $reason = "PLEASE WAIT!"): void
    {
        $this->playersJoined[$player->getName()][] = [
            $closureTask,
            $reason
        ];
    }

    public function addEntityTeleport(Entity $entity, ClosureTask $closureTask, string $reason = "PLEASE WAIT!"): void
    {
        $this->entitiesTeleporting[$entity->getId()][] = [
            $closureTask,
            $reason
        ];
    }
}