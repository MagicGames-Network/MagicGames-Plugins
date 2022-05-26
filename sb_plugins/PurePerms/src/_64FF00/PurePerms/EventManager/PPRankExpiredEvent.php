<?php

namespace _64FF00\PurePerms\EventManager;

use pocketmine\Server;
use pocketmine\world\World;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;
use pocketmine\event\plugin\PluginEvent;

class PPRankExpiredEvent extends PluginEvent
{
    private IPlayer $player;
    private ?string $worldName;

    public function __construct(PurePerms $plugin, IPlayer $player, ?string $worldName)
    {
        parent::__construct($plugin);

        $this->player = $player;
        $this->worldName = $worldName;
    }

    public function getWorldName(): ?string
    {
        return $this->worldName;
    }

    public function getPlayer(): IPlayer
    {
        return $this->player;
    }
}
