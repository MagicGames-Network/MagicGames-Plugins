<?php

//  ██████╗░██╗░░░██╗░██████╗██╗░░██╗██╗░░██╗░█████╗░██████╗░
//  ██╔══██╗██║░░░██║██╔════╝██║░░██║██║░██╔╝██╔══██╗██╔══██╗
//  ██████╔╝██║░░░██║╚█████╗░███████║█████═╝░███████║██████╔╝
//  ██╔═══╝░██║░░░██║░╚═══██╗██╔══██║██╔═██╗░██╔══██║██╔══██╗
//  ██║░░░░░╚██████╔╝██████╔╝██║░░██║██║░╚██╗██║░░██║██║░░██║
//  ╚═╝░░░░░░╚═════╝░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝

namespace Pushkar\MagicCore;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use alemiz\sga\StarGateAtlantis;
use pocketmine\plugin\PluginBase;
use muqsit\invmenu\InvMenuHandler;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\data\bedrock\EnchantmentIdMap;
use Pushkar\MagicCore\listener\EventListener;
use Pushkar\MagicCore\managers\CommandManager;

class Main extends PluginBase implements Listener
{
    public const PREFIX = " §e";
    public const VERSION = "v4.0.0";
    public const FAKE_ENCH_ID = -1;

    private static Main $instance;

    public array $skin = [];

    public function onLoad(): void
    {
        self::$instance = $this;
        $this->getLogger()->info("§eLoading MagicGamesCore");
        
        /** @var array $loadWorlds */
        $loadWorlds = $this->getConfig()->get("load-worlds");
        /** @var string $world */
        foreach ($loadWorlds as $world) {
            if ($this->getServer()->getWorldManager()->loadWorld($world)) {
                $this->getLogger()->info("§eWorld ${world} Has Been Successfully Loaded");
            }
        }
    }

    public function onEnable(): void
    {
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }

        $cmdMap = $this->getServer()->getCommandMap();
        $pmmpversion = $cmdMap->getCommand("version");
        $pmmpver = $cmdMap->getCommand("ver");
        $pmmpabout = $cmdMap->getCommand("about");
        $pmmpclear = $cmdMap->getCommand("clear");

        $pmmpversion instanceof Command ? $cmdMap->unregister($pmmpversion) : null;
        $pmmpabout instanceof Command ? $cmdMap->unregister($pmmpabout) : null;
        $pmmpver instanceof Command ? $cmdMap->unregister($pmmpver) : null;
        $pmmpclear instanceof Command ? $cmdMap->unregister($pmmpclear) : null;

        //$this->getServer()->getNetwork()->setName($this->getConfig()->get("server-modt"));
        EnchantmentIdMap::getInstance()->register(self::FAKE_ENCH_ID, new Enchantment("Glow", 1, ItemFlags::ALL, ItemFlags::NONE, 1));
        
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

        CommandManager::initalize();
        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }

    public function onDisable(): void
    {
        Server::getInstance()->broadcastMessage("§l§e§k!!!§r §l§cSERVER RESTARTING §e§k!!!");
        if ($this->getConfig()->get("Crash-Rejoin") === true) {
            foreach ($this->getServer()->getOnlinePlayers() as $sender) {
                $sender->sendTitle("§cServer Restarting");
                $sender->transfer($this->getConfig()->get("IP"), $this->getConfig()->get("Port"));
                $name = $sender->getName();
                $this->getLogger()->info("§ePlayer ${name} Has Been Successfully Transfered");
            }
        }
    }
    
    public function naturalMoneyLoss(Player $sender, float $senderMoney): void
    {
        if (!$this->getConfig()->get("LoseMoneyNaturally")) return;

        $moneyLoss = $this->getConfig()->get("Money-Loss");
        if (!is_numeric($moneyLoss)) {
            return;
        }

        switch ($this->getConfig()->get("Type")) {
            case "all":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney);
                EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney);
                break;
            case "half":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney / 2);
                EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney / 2);
                break;
            case "amount":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . (float)$moneyLoss);
                EconomyAPI::getInstance()->reduceMoney($sender, (float)$moneyLoss);
                break;
            case "percent":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . ((float)$moneyLoss / 100) * $senderMoney);
                EconomyAPI::getInstance()->reduceMoney($sender, ((float)$moneyLoss / 100) * $senderMoney);
                break;
        }
    }
}
