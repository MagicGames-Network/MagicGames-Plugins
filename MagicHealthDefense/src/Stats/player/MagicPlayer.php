<?php

namespace Stats\player;

use Stats\Main;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;

class MagicPlayer extends Player
{
    public array $stats = [
        "MaxHealth" => 20,
        "Health" => 20,
        "Defense" => 0,
        "Damage" => 1,
    ];

    public function getHealth(): float
    {
        return $this->stats["Health"];
    }

    public function getMaxHealth(): int
    {
        return $this->stats["MaxHealth"];
    }

    public function getDefense(): int
    {
        return $this->stats["Defense"];
    }

    public function getDamage(): int
    {
        return $this->stats["Damage"];
    }

    protected function onDeath(): void
    {
        $world = Main::getInstance()->getServer()->getWorldManager()->getDefaultWorld();
        $ev = new PlayerDeathEvent($this, $this->getDrops(), $this->getXpDropAmount(), null);

        Main::getInstance()->getServer()->broadcastMessage($ev->getDeathMessage());
        $this->teleport($world->getSpawnLocation());
        $this->stats["Health"] = $this->stats["MaxHealth"];
    }

    public function isAlive(): bool
    {
        if ($this->getHealth() > 0) {
            return true;
        }
        return false;
    }

    public function setStats(string $stats, float $amount): void
    {
        switch ($stats) {
            case "MaxHealth":
                if ($amount <= 0) {
                    $this->setMaxHealth(1);
                }
                break;
            case "Health":
                if ($amount <= 0) {
                    $this->onDeath();
                    break;
                }
                if ($amount > $this->getMaxHealth()) {
                    $this->setHealth($this->getMaxHealth());
                    break;
                }
                if ($amount < $this->getHealth()) {
                    $this->setHealth($amount);
                    $this->setMaxHealth((int)$amount);
                }
                break;
            default:
                $this->stats[$stats] = $amount;
                break;
        }
    }

    public function setHealth(float $amount): void
    {
        switch (true) {
            case $amount <= true:
                $this->stats["Health"] = 0;
                $this->onDeath();
                break;
            case $amount > $this->getMaxHealth():
                $this->stats["Health"] = $this->getMaxHealth();
                break;
            default:
                $this->stats["Health"] = $amount;
                break;
        }
    }

    public function heal(EntityRegainHealthEvent $source): void
    {
        $source->call();
        if ($source->isCancelled()) {
            return;
        }
        $this->setHealth($this->getHealth() + $source->getAmount());
    }

    public function setMaxHealth(int $amount): void
    {
        $this->stats["MaxHealth"] = $amount;
    }
}
