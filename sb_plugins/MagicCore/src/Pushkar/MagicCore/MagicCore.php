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
use pocketmine\plugin\PluginBase;
use muqsit\invmenu\InvMenuHandler;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\enchantment\ItemFlags;
use Pushkar\MagicCore\utils\Configuration;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\data\bedrock\EnchantmentIdMap;
use Pushkar\MagicCore\listener\EventListener;
use Pushkar\MagicCore\managers\CommandManager;

class MagicCore extends PluginBase implements Listener
{
    public const PREFIX = " §e";
    public const VERSION = "v4.0.0";
    public const FAKE_ENCH_ID = -1;

    private static MagicCore $instance;

    public array $skin = [];

    public array $bitsMoney = [];

    public function onLoad(): void
    {
        self::$instance = $this;

        /** @var string $world */
        foreach (Configuration::$worldsToLoad as $world) {
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

        @mkdir($this->getDataFolder() . "Players");

        $cmdMap = $this->getServer()->getCommandMap();
        $pmmpversion = $cmdMap->getCommand("version");
        $pmmpver = $cmdMap->getCommand("ver");
        $pmmpabout = $cmdMap->getCommand("about");
        $pmmpclear = $cmdMap->getCommand("clear");

        $pmmpversion instanceof Command ? $cmdMap->unregister($pmmpversion) : null;
        $pmmpabout instanceof Command ? $cmdMap->unregister($pmmpabout) : null;
        $pmmpver instanceof Command ? $cmdMap->unregister($pmmpver) : null;
        $pmmpclear instanceof Command ? $cmdMap->unregister($pmmpclear) : null;

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

    public static function getInstance(): MagicCore
    {
        return self::$instance;
    }

    public function onDisable(): void
    {
        $this->saveAllData();
        if (Configuration::$rejoinOnStop) {
            foreach ($this->getServer()->getOnlinePlayers() as $player) {
                $playerName = $player->getName();

                $player->sendTitle("§cServer Restarting");
                $player->transfer(Configuration::$rejoinIP, (int) Configuration::$rejoinPort);
                $this->getLogger()->info("§ePlayer ${playerName} Has Been Successfully Transfered");
            }
        }
    }

    public function naturalMoneyLoss(Player $sender, float $senderMoney): void
    {
        if (Configuration::$naturalMoneyLost) {
            return;
        }

        $moneyLoss = Configuration::$moneyLoseAmount;
        switch (Configuration::$loseMoneyType) {
            case "all":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney);
                EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney);
                break;
            case "half":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $senderMoney / 2);
                EconomyAPI::getInstance()->reduceMoney($sender, $senderMoney / 2);
                break;
            case "amount":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . $moneyLoss);
                EconomyAPI::getInstance()->reduceMoney($sender, $moneyLoss);
                break;
            case "percent":
                $sender->sendMessage("§c§lINFO > §r§bYou Died And Lost §e$" . ($moneyLoss / 100) * $senderMoney);
                EconomyAPI::getInstance()->reduceMoney($sender, ($moneyLoss / 100) * $senderMoney);
                break;
        }
    }

    public function saveAllData(): void
    {
        foreach ($this->bitsMoney as $player => $amount) {
            $bits = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $bits->set("Bits", $amount);
            $bits->save();
        }
    }

    public function loadData(Player $player): void
    {
        $bits = new Config($this->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML);
        $this->bitsMoney[$player->getName()] = $bits->get("Bits");
    }

    public function saveData(Player $player): void
    {
        if (isset($this->bitsMoney[$player->getName()])) {
            $bits = new Config($this->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML);
            $bits->set("Bits", $this->bitsMoney[$player->getName()]);
            $bits->save();
        }
    }

    public function giveBitsBalance(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->bitsMoney[$player]) && is_numeric($this->bitsMoney[$player])) {
            $this->bitsMoney[$player] = $this->bitsMoney[$player] + $amount;
        } else {
            $bits = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $bits->set("Bits", $bits->get("Bits") + $amount);
            $bits->save();
        }
    }

    public function takeBitsBalance(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->bitsMoney[$player])) {
            $this->bitsMoney[$player] = $this->bitsMoney[$player] - $amount;
        } else {
            $bits = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $bits->set("Bits", $bits->get("Bits") - $amount);
            $bits->save();
        }
    }

    public function getBitsBalance(string $player): float
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->bitsMoney[$player])) {
            return (float) $this->bitsMoney[$player];
        } else {
            $bits = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $money = (float) $bits->get("Bits");
            $bits->save();
            return $money;
        }
    }
}
