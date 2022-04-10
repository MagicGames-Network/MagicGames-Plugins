<?php

namespace Stats;

use pocketmine\utils\Config;
use Stats\player\MagicPlayer;
use Stats\task\ActionbarTask;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener
{
    private static Main $instance;

    public static function getInstance(): Main
    {
        return self::$instance;
    }

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new ActionbarTask(), 20);
        self::$instance = $this;
        if (!file_exists($this->getDataFolder() . "data")) {
            mkdir($this->getDataFolder() . "data", 0777);
        }
    }

    public function onDisable(): void
    {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            if ($player instanceof MagicPlayer) {
                $playerName = $player->getName();
                if (file_exists($this->getDataFolder() . "data/$playerName.yml")) {
                    $config = new Config($this->getDataFolder() . "data/$playerName.yml", Config::YAML);
                    foreach ($player->stats as $stat => $value) {
                        $arrays = $config->get("Stats");
                        $arrays[$stat] = $value;
                        $config->set("Stats", $arrays);
                        $config->save();
                    }
                }
            }
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if ($command->getName() == "hdset") {
            if ($this->getServer()->isOp($sender->getName()) || $sender->hasPermission($command->getPermission() ?? "hdset.use")) {
                if (isset($args[0])) {
                    if (isset($args[1])) {
                        $player = $this->getServer()->getPlayerByPrefix($args[0]);
                        if ($player instanceof MagicPlayer) {
                            if (isset($player->stats[$args[1]])) {
                                if (isset($args[2])) {
                                    if (is_numeric($args[2])) {
                                        $player->setStats($args[1], (float)$args[2]);
                                        if ($sender->getName() != $player->getName()) {
                                            $sender->sendMessage("§aChanged the stats of " . $player->getName() . ".");
                                        }
                                        return true;
                                    }
                                    $sender->sendMessage("§cPut in numeric value.");
                                    return false;
                                }
                                $sender->sendMessage($command->getUsage());
                                return false;
                            }
                            $sender->sendMessage("§cStats §anot found.");
                            return false;
                        }
                        $sender->sendMessage("§cPlayer not found.");
                        return false;
                    }
                    $sender->sendMessage($command->getUsage());
                }
                return false;
            }
            $sender->sendMessage("§cNo Permission");
        }
        return false;
    }

    public function onPlayerCreation(PlayerCreationEvent $event): void
    {
        $event->setPlayerClass(MagicPlayer::class);
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        if ($player instanceof MagicPlayer) {
            $playerName = $player->getName();
            if (!file_exists($this->getDataFolder() . "data/$playerName.yml")) {
                $config = new Config($this->getDataFolder() . "data/$playerName.yml", Config::YAML);
                $config->set("Stats", $player->stats);
                $config->save();
                return;
            }
            $config = new Config($this->getDataFolder() . "data/$playerName.yml", Config::YAML);
            foreach ($config->get("Stats") as $stat => $value) {
                if (isset($player->stats[$stat])) {
                    $player->stats[$stat] = $value;
                }
            }
        }
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        if ($player instanceof MagicPlayer) {
            $playerName = $player->getName();
            if (file_exists($this->getDataFolder() . "data/$playerName.yml")) {
                $config = new Config($this->getDataFolder() . "data/$playerName.yml", Config::YAML);
                foreach ($player->stats as $stat => $value) {
                    $arrays = $config->get("Stats");
                    $arrays[$stat] = $value;
                    $config->set("Stats", $arrays);
                    $config->save();
                }
            }
        }
    }

    public function onDamage(EntityDamageEvent $event): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $victim = $event->getEntity();
            $damager = $event->getDamager();
            if ($damager instanceof MagicPlayer) {
                if ($victim instanceof MagicPlayer) {
                    $dmg = $damager->getDamage() - 1 + $event->getFinalDamage() - $victim->getDefense() + $victim->getArmorPoints();
                    if ($dmg > 0) {
                        $event->setBaseDamage($dmg);
                        return;
                    }
                    $event->setBaseDamage(1);
                    return;
                }
                $a = $damager->getDamage() + $event->getFinalDamage() - 1;
                $event->setBaseDamage($a);
                return;
            }
            if ($victim instanceof MagicPlayer) {
                $a = $event->getFinalDamage();
                $d = $victim->getDefense();
                if ($a - $d <= 0) {
                    $event->setBaseDamage(1);
                    return;
                }
                $event->setBaseDamage($a - $d);
            }
        }
    }
}
