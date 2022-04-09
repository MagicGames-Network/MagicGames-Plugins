<?php

namespace Stats;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;


class Main extends PluginBase implements Listener{

    private static $instance;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new Tick(), 20);
        self::$instance = $this;
        if(!file_exists($this->getDataFolder()."Jogadores")){
            mkdir($this->getDataFolder()."Jogadores", 0777);
        }
    }

    public function onDisable(): void
    {
        foreach ($this->getServer()->getOnlinePlayers() as $player){
            if(!$player instanceof Segundo) return;
            $pn = $player->getName();
            if(file_exists($this->getDataFolder()."Jogadores/$pn.yml")){
                $config = new Config($this->getDataFolder()."Jogadores/$pn.yml", Config::YAML);
                foreach ($player->stats as $stat => $value){
                    $arrays = $config->get("Stats");
                    $arrays[$stat] = $value;
                    $config->set("Stats", $arrays);
                    $config->save();
                }
            }
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() == "hdset"){
            if($this->getServer()->isOp($sender->getName()) or $sender->hasPermission($command->getPermission())) {
                if (isset($args[0])) {

                    if (isset($args[1])) {
                        $player = $this->getServer()->getPlayerByPrefix($args[0]);
                        if ($player instanceof Segundo) {
                            if (isset($player->stats[$args[1]])) {
                                if (isset($args[2])) {
                                    if (is_numeric($args[2])) {
                                        $player->setStats($args[1], $args[2]);
                                        if($sender->getName() != $player->getName()){
                                            $sender->sendMessage("§aChanged the stats of ".$player->getName().".");
                                        }
                                        
                                    } else {
                                        $sender->sendMessage("§cPut in numeric value.");
                                    }
                                } else {
                                    $sender->sendMessage($command->getUsage());
                                }
                            } else {
                                $sender->sendMessage("§cStats §anot found.");
                            }
                        } else {
                            $sender->sendMessage("§cPlayer not found.");
                        }
                    } else {
                        $sender->sendMessage($command->getUsage());
                    }

                } else {
                    $sender->sendMessage($command->getUsage());
                }
            }else{
                $sender->sendMessage("§cNo Permission");
            }
        }
        return true;
    }

    public function NewPlayer(PlayerCreationEvent $event)
    {
        $event->setPlayerClass(Segundo::class);
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if(!$player instanceof Segundo) return;
        $pn = $player->getName();
        if(!file_exists($this->getDataFolder()."Jogadores/$pn.yml")){
            $config = new Config($this->getDataFolder()."Jogadores/$pn.yml", Config::YAML);
            $config->set("Stats", $player->stats);
            $config->save();
        }else{
            $config = new Config($this->getDataFolder()."Jogadores/$pn.yml", Config::YAML);
            foreach ($config->get("Stats") as $stat => $value){
                if(isset($player->stats[$stat])){
                    $player->stats[$stat] = $value;
                }
            }
        }
    }

    public function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        if(!$player instanceof Segundo) return;
        $pn = $player->getName();
        if(file_exists($this->getDataFolder()."Jogadores/$pn.yml")){
            $config = new Config($this->getDataFolder()."Jogadores/$pn.yml", Config::YAML);
            foreach ($player->stats as $stat => $value){
                $arrays = $config->get("Stats");
                $arrays[$stat] = $value;
                $config->set("Stats", $arrays);
                $config->save();
            }
        }
    }

    public function onDamage(EntityDamageEvent $event)
    {
        if($event instanceof EntityDamageByEntityEvent)
        {
            $vitima = $event->getEntity();
            $killer = $event->getDamager();
            if($killer instanceof Segundo)
            {
                if($vitima instanceof Segundo)
                {
                    $dmg = $killer->getDamage() - 1 + $event->getFinalDamage() - $vitima->getDefense() + $vitima->getArmorPoints();
                    if($dmg > 0){
                        $event->setBaseDamage($dmg);
                    }else{
                        $event->setBaseDamage(1);
                    }
                }else{
                    $a = $killer->getDamage() + $event->getFinalDamage() - 1;
                    $event->setBaseDamage($a);
                }
            }else{
                if($vitima instanceof Segundo){
                    $a = $event->getFinalDamage();
                    $d = $vitima->getDefense();
                    if($a - $d <= 0){
                        $event->setBaseDamage(1);
                    }else{
                        $event->setBaseDamage($a-$d);
                    }
                }
            }
        }
    }

}
