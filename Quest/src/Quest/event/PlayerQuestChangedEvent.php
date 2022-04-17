<?php

namespace Quest\event;

use pocketmine\event\Event;
use pocketmine\player\Player;

class PlayerQuestChangedEvent extends Event
{
    private Player $player;

    private string $newQuest;

    public function __construct(Player $player, string $newQuest)
    {
        $this->player = $player;
        $this->newQuest = $newQuest;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getNewQuest(): string
    {
        return $this->newQuest;
    }

}