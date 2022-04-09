<?php

#  ██████╗░██╗░░░██╗░██████╗██╗░░██╗██╗░░██╗░█████╗░██████╗░
#  ██╔══██╗██║░░░██║██╔════╝██║░░██║██║░██╔╝██╔══██╗██╔══██╗
#  ██████╔╝██║░░░██║╚█████╗░███████║█████═╝░███████║██████╔╝
#  ██╔═══╝░██║░░░██║░╚═══██╗██╔══██║██╔═██╗░██╔══██║██╔══██╗
#  ██║░░░░░╚██████╔╝██████╔╝██║░░██║██║░╚██╗██║░░██║██║░░██║
#  ╚═╝░░░░░░╚═════╝░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝

namespace Pushkar\MagicCore;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
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
    public const FAKE_ENCH_ID = -1;

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

    public function onLoad(): void
    {
        self::$instance = $this;
        $this->getLogger()->info("§eLoading MagicGamesCore");
        foreach ($this->getConfig()->get("load-worlds") as $AllWorlds) {
            if ($this->getServer()->getWorldManager()->loadWorld($AllWorlds)) {
                $this->getLogger()->info("§eWorld ${AllWorlds} Has Been Successfully Loaded");
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
        $cmdMap->unregister($pmmpversion);
        $cmdMap->unregister($pmmpabout);
        $cmdMap->unregister($pmmpver);
        #$this->getServer()->getNetwork()->setName($this->getConfig()->get("server-modt"));
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
        $this->pickupfullInvPopup = $this->getConfig()->get('pickup-full-inventory', '');
        $this->pickupmode = $this->getConfig()->get('pickupmode', 'blacklist');
        $this->pickupaffectedWorlds = $this->getConfig()->get('pickupworlds', []);
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
        if ($this->getConfig()->get("Crash-Rejoin") === true) {
            foreach ($this->getServer()->getOnlinePlayers() as $sender) {
                if (!$sender instanceof Player)
                    $sender->sendMessage("§l§cDISCONNECTED FROM SERVER\n§r§bServer Is Restarting");
                $server = $this->getConfig()->get("Crash-Rejoin-Server");
                $player = $sender->getName();
                StarGateAtlantis::getInstance()->transferPlayer($sender, $server);
                $this->getLogger()->info("§eSuccessfully Transfered Player ${player}");
            }
        }
    }
    
    /**
     * @param string $level
     * @return bool
     */
    public function shouldPickup(string $level): bool
    {
        if (strtolower($this->pickupmode) == 'blacklist') {
            if (in_array($level, $this->pickupaffectedWorlds))
                return false;
        } elseif (strtolower($this->pickupmode) == 'whitelist') {
            if (!in_array($level, $this->pickupaffectedWorlds))
                return false;
        }
        return true;
    }

    public function naturalMoneyLoss($sender, $senderMoney)
    {
        if (!$this->getConfig()->get("LoseMoneyNaturally")) return;
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
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . (float)$this->getConfig()->get("Money-Loss"));
                EconomyAPI::getInstance()->reduceMoney($sender, (float)$this->getConfig()->get("Money-Loss"));
                break;
            case "percent":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . ((float)$this->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                EconomyAPI::getInstance()->reduceMoney($sender, ((float)$this->getConfig()->get("Money-Loss") / 100) * $senderMoney);
                break;
        }
    }
}
