<?php

namespace Stats;

use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;

class Segundo extends Player{
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
        if($this->getHealth() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function setStats(string $stats, float $amount): void
    {
        if($stats == "MaxHealth" and $amount <= 0){
            $this->setMaxHealth(1);
             return;
        }
        if($stats == "Health" and $amount <= 0){
            $this->onDeath();
        }elseif($stats == "Health" and $amount > $this->getMaxHealth()){
            $this->setHealth($this->getMaxHealth());
        }elseif($stats == "MaxHealth" and $amount < $this->getHealth()){
            $this->setHealth($amount);
            $this->setMaxHealth($amount);
        }else{
            $this->stats[$stats] = $amount;
        }
    }

    public function setHealth(float $amount): void
    {
        if($amount <= 0)
        {
            $this->stats["Health"] = 0;
            $this->onDeath();
        }elseif($amount > $this->getMaxHealth()){
            $this->stats["Health"] = $this->getMaxHealth();
        }else{
            $this->stats["Health"] = $amount;
        }
    }

    public function heal(EntityRegainHealthEvent $source): void
    {
        $source->call();
        if($source->isCancelled()){
            return;
        }
        $this->setHealth($this->getHealth() + $source->getAmount());
    }

    public function setMaxHealth(int $amount): void
    {
        $this->stats["MaxHealth"] = $amount;
    }
}