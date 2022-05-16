<?php

namespace AGTHARN\BankUI;

use pocketmine\plugin\PluginBase;
use AGTHARN\BankUI\command\BankCommand;
use AGTHARN\BankUI\session\SessionManager;

class Main extends PluginBase
{
    private static Main $instance;
    private SessionManager $sessionManager;

    public static function getInstance(): Main
    {
        return self::$instance;
    }

    public function onEnable(): void
    {
        @mkdir($this->getDataFolder() . "data");
        
        self::$instance = $this;
        $this->sessionManager = new SessionManager();
        
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getCommandMap()->register("bankui", new BankCommand($this, "bank", "Opens The BankUI!", ["bankui"]));
    }

    public function getSessionManager(): SessionManager
    {
        return $this->sessionManager;
    }
}
