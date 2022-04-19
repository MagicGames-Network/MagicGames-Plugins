<?php

namespace _64FF00\PurePerms\Task;

use pocketmine\scheduler\Task;
use _64FF00\PurePerms\PurePerms;
use _64FF00\PurePerms\EventManager\PPRankExpiredEvent;

class PPExpDateCheckTask extends Task
{
    private PurePerms $plugin;

    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(): void
    {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if (time() === $this->plugin->getUserDataMgr()->getNode($player, "expTime")) {
                $worldName = $this->plugin->getConfigValue("enable-multiworld-perms") ? $player->getWorld()->getFolderName() : null;
                $event = new PPRankExpiredEvent($this->plugin, $player, $worldName);
                $event->call();
            }
        }
    }
}
