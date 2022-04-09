<?php

#  ██████╗░██╗░░░██╗░██████╗██╗░░██╗██╗░░██╗░█████╗░██████╗░
#  ██╔══██╗██║░░░██║██╔════╝██║░░██║██║░██╔╝██╔══██╗██╔══██╗
#  ██████╔╝██║░░░██║╚█████╗░███████║█████═╝░███████║██████╔╝
#  ██╔═══╝░██║░░░██║░╚═══██╗██╔══██║██╔═██╗░██╔══██║██╔══██╗
#  ██║░░░░░╚██████╔╝██████╔╝██║░░██║██║░╚██╗██║░░██║██║░░██║
#  ╚═╝░░░░░░╚═════╝░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝

namespace Pushkar\MagicCore;

use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use Pushkar\MagicCore\listener\EventListener;
use Pushkar\MagicCore\managers\CommandManager;
use pocketmine\Server;
use Closure;
use alemiz\sga\StarGateAtlantis;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\EventPriority;
use muqsit\invmenu\InvMenuHandler;

class Main extends PluginBase implements Listener
{  
    protected $skin = [];
  /** @var string $fullInvPopup */
    protected $pickupfullInvPopup;

    /** @var string $mode */
    protected $pickupmode;

    /** @var array $affectedWorlds */
    protected $pickupaffectedWorlds;
    
    private Config $pdata;
    
    const PREFIX = "§e§lMAGICGAMES >§r§b ";
  	const VERSION = "v4.0.0";
      private static Main $instance;
  	
 public function onLoad(): void {
     self::$instance = $this;
   $this->getLogger()->info("§eLoading MagicGamesCore");
		foreach ($this->getConfig()->get("load-worlds") as $AllWorlds){
			if($this->getServer()->getWorldManager()->loadWorld($AllWorlds)){
       $this->getLogger()->info("§eWorld ${AllWorlds} Has Been Successfully Loaded");
			}
		}
	} 
 public function onEnable() : void
    {
      if (!InvMenuHandler::isRegistered()) {
				InvMenuHandler::register($this);
			}
			$cmdMap = $this->getServer()->getCommandMap();
		  foreach ($this->getConfig()->get("unregister-commands") as $uncommands){
		    $cmdMap->unregister($uncommands);
		    $this->getLogger()->info("§eThe Commands ${uncommands} Has Been Successfully Unregistered");
		  }
		  $this->getServer()->getNetwork()->setName($this->getConfig()->get("server-modt"));
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      $this->getLogger()->info("Plugins Made For MagicGames, Copyright By MagicGames™ ©
                                ███╗░░░███╗░█████╗░░██████╗░██╗░█████╗░░██████╗░░█████╗░███╗░░░███╗███████╗░██████╗
                                ████╗░████║██╔══██╗██╔════╝░██║██╔══██╗██╔════╝░██╔══██╗████╗░████║██╔════╝██╔════╝
                                ██╔████╔██║███████║██║░░██╗░██║██║░░╚═╝██║░░██╗░███████║██╔████╔██║█████╗░░╚█████╗░
                                ██║╚██╔╝██║██╔══██║██║░░╚██╗██║██║░░██╗██║░░╚██╗██╔══██║██║╚██╔╝██║██╔══╝░░░╚═══██╗
                                ██║░╚═╝░██║██║░░██║╚██████╔╝██║╚█████╔╝╚██████╔╝██║░░██║██║░╚═╝░██║███████╗██████╔╝
                                ╚═╝░░░░░╚═╝╚═╝░░╚═╝░╚═════╝░╚═╝░╚════╝░░╚═════╝░╚═╝░░╚═╝╚═╝░░░░░╚═╝╚══════╝╚═════╝░
                                Made By Namless And Pushkar");
      
        $this->reloadConfig();
        $this->pickupfullInvPopup = $this->getConfig()->get('pickup-full-inventory', '');
        $this->pickupmode = $this->getConfig()->get('pickupmode', 'blacklist');
        $this->pickupaffectedWorlds = $this->getConfig()->get('pickupworlds', []);
        $handlerClosure = Closure::fromCallable([$this, 'onBreak']);
        try {
            $this->getServer()->getPluginManager()->registerEvent(BlockBreakEvent::class, $handlerClosure, EventPriority::HIGHEST, $this);
        } catch (ReflectionException $e) {
            $this->getLogger()->critical($e->getMessage());
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
        CommandManager::initalize();
        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(),$this);
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }
    
    public function onDisable(): void{
        if ($this->getConfig()->get("Crash-Rejoin") === true) {
            foreach ($this->getServer()->getOnlinePlayers() as $sender) {
                $sender->sendMessage("§l§cSERVER RESTARTING");
                StarGateAtlantis::getInstance()->transferPlayer($sender, $this->getConfig()->get("Crash-Rejoin-Server"));
            }
        }
    }
    /**
     * @param string $level
     * @return bool
     */
    private function shouldPickup(string $level): bool
    {
        if(strtolower($this->pickupmode) == 'blacklist') {
            if(in_array($level, $this->pickupaffectedWorlds))
                return false;
        } elseif (strtolower($this->pickupmode) == 'whitelist') {
            if(!in_array($level, $this->pickupaffectedWorlds))
                return false;
        }
        return true;
    }
    
    public function naturalMoneyLoss($sender, $senderMoney)
    {
        if (!$this->getConfig()->get("LoseMoneyNaturally")) return;
        if ($this->getConfig()->get("Type") == "all"){
            $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney);
            EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney);
        }
        if ($this->getConfig()->get("Type") == "half"){
            $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney / 2);
            EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney / 2);
        }
        if ($this->getConfig()->get("Type") == "amount"){
            $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . (double)$this->getConfig()->get("Money-Loss"));
            EconomyAPI::getInstance()->reduceMoney($sender, (double)$this->getConfig()->get("Money-Loss"));
        }
        if ($this->getConfig()->get("Type") == "percent"){
            $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . ((double)$this->getConfig()->get("Money-Loss") / 100) * $senderMoney);
            EconomyAPI::getInstance()->reduceMoney($sender, ((double)$this->getConfig()->get("Money-Loss") / 100) * $senderMoney);
        }
    }
}
