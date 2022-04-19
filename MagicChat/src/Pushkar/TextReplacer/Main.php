<?php
namespace Pushkar\TextReplacer;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getCommandsConfig = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $cmdMap = $this->getServer()->getCommandMap();
        $pmmpme = $cmdMap->getCommand("me");
        $pmmpme instanceof Command ? $cmdMap->unregister($pmmpme) : null;
        
    }

    public function onChat(PlayerChatEvent $event): void{
        $player = $event->getPlayer();
        /*if(strlen($player->getMessage()) >= 35){
          $player->sendMessage("§7(§d!§7) §bYou Can't Type 35 Letters At Once!");
          $event->cancel();
          return;
        }*/
        $commandsConfig = $this->getCommandsConfig()->getAll();
        foreach ($commandsConfig["TextReplacer"] as $var){
            $message = str_replace($var["Before"], $var["After"], $event->getMessage());
            $event->setMessage($message);
        }
    }

    public function getCommandsConfig(){
        return $this->getCommandsConfig;
    }
}
