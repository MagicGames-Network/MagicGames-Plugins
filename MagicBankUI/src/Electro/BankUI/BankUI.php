<?php

namespace Electro\BankUI;

use jojoe77777\FormAPI\Form;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;
use CortexPE\DiscordWebhookAPI\Embed;
use pocketmine\event\player\PlayerInteractEvent;

class BankUI extends PluginBase implements Listener
{
    private static BankUI $instance;
    public array $playersMoney = [];
    public array $playersTransactions = [];

    public static function getInstance(): BankUI
    {
        return self::$instance;
    }

    public function onEnable(): void
    {
        self::$instance = $this;

        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        @mkdir($this->getDataFolder() . "Players");
        if ($this->getConfig()->get("enable-interest")) {
            $this->interestTask();
        }
    }

    public function onDisable(): void
    {
        $this->saveAllData();
    }

    public function interestTask(): void
    {
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(
            function () {
                $this->dailyInterest();
            }
        ), 1728000);
    }

    public function dailyInterest(): void
    {
        if (date("H:i") === "12:00") {
            $glob = glob($this->getDataFolder() . "Players/*.yml");
            if (!$glob) {
                return;
            }

            foreach ($glob as $players) {
                $playerBankMoney = new Config($players);
                $interest = ($this->getConfig()->get("interest-rates") / 100 * $playerBankMoney->get("Money"));
                $playerBankMoney->set("Money", round($playerBankMoney->get("Money") + $interest));
                $playerBankMoney->save();
                if ($playerBankMoney->get('Transactions') === 0) {
                    $playerBankMoney->set('Transactions', date("§b[d/m/y]") . "§e - §aInterest $" . round($interest) . "\n");
                } else {
                    $playerBankMoney->set('Transactions', $playerBankMoney->get('Transactions') . date("§b[d/m/y]") . "§e - §a$" . round($interest) . " from interest" . "\n");
                }
                $playerBankMoney->save();
            }
            foreach ($this->getServer()->getOnlinePlayers() as $onlinePlayers) {
                $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $onlinePlayers->getName() . ".yml", Config::YAML);
                $onlinePlayers->sendMessage("§aYou have earned $" . round(($this->getConfig()->get("interest-rates") / 100) * $playerBankMoney->get("Money")) . " from bank interest");
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        if (!file_exists($this->getDataFolder() . "Players/" . $player->getName() . ".yml")) {
            new Config($this->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML, array(
                "Money" => 0,
                "Transactions" => 0,
            ));
        }
        $this->loadData($player);
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        $this->saveData($player);
        unset($this->playersMoney[$player->getName()]);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "bank":
                if ($sender instanceof Player) {
                    if (isset($args[0]) && $sender->hasPermission("bankui.admin") || isset($args[0]) && $sender->hasPermission("DefaultPermissions::ROOT_OPERATOR")) {
                        if (!file_exists($this->getDataFolder() . "Players/" . $args[0] . ".yml")) {
                            $sender->sendMessage("§c§lError: §r§aThis player does not have a bank account");
                            return true;
                        }
                        $this->adminForm($sender, $args[0]);
                        return true;
                    }
                    $this->bankForm($sender);
                }
        }
        return true;
    }

    public function bankForm(Player $player): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->withdrawForm($player);
                    break;
                case 1:
                    $this->depositForm($player);
                    break;
                case 2:
                    $this->transferCustomForm($player);
                    break;
                case 3:
                    $this->transactionsForm($player);
                    break;
                case 4:
                    $this->notesForm($player);
            }
        });
        $name = $player->getName();
        $coins = EconomyAPI::getInstance()->myMoney($player);
        $form->setTitle("§6»§2BANK MENU§6«");
        $form->setContent("§bHi, $name \n\n§bWelcome To Bank Menu\n§bBank Internet Rate is §e1percent§r\n\n§bYour Money: §e$ $coins \n§bBank Balance: §e$ " . $this->getMoney($player->getName()));
        $form->addButton("§6» §2Withdraw Money §6«\n§8Click To Withdraw", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§6» §2Deposit Money §6«\n§8Click To Deposit", 1, "https://cdn-icons-png.flaticon.com/128/1041/1041888.png");
        $form->addButton("§6» §2Transfer Money §6«\n§8Click To Transfer", 1, "https://cdn-icons-png.flaticon.com/128/1790/1790213.png");
        $form->addButton("§6» §2Transaction §6«\n§8Click To Open", 1, "https://cdn-icons-png.flaticon.com/128/3135/3135679.png");
        $form->addButton("§6» §2Notes §6«\n§8Click To Open", 1, "https://cdn-icons-png.flaticon.com/128/1043/1043445.png");
        $form->addButton("§cExit", 1, "https://cdn-icons-png.flaticon.com/128/2698/2698776.png");
        $player->sendForm($form);
        return $form;
    }

    public function adminForm(Player $player, string $target): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) use ($target) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->adminGiveForm($player, 0, $target);
                    break;
                case 1:
                    $this->adminGiveForm($player, 1, $target);
                    break;
                case 2:
                    $this->adminGiveForm($player, 2, $target);
                    break;
                case 3:
                    $this->otherTransactionsForm($player, $target);
            }
        });

        $form->setTitle("§l" . $target . "'s Bank");
        $form->setContent("Balance: $" . $this->getMoney($target));
        $form->addButton("§lAdd Money\n§r§dClick to add...", 0, "textures/ui/icon_book_writable");
        $form->addButton("§lTake Money\n§r§dClick to take...", 0, "textures/items/map_filled");
        $form->addButton("§lSet Money\n§r§dClick to set...", 0, "textures/ui/FriendsIcon");
        $form->addButton("§lTransactions\n§r§dClick to open...", 0, "textures/ui/lock_color");
        $form->addButton("§l§cEXIT\n§r§dClick to close...", 0, "textures/ui/cancel");
        $player->sendForm($form);
        return $form;
    }

    public function adminGiveForm(Player $player, int $action, string $target): Form
    {
        $form = new CustomForm(function (Player $player, $data) use ($action, $target) {
            if ($data === null) {
                return true;
            }

            if (!is_numeric($data[1])) {
                $player->sendMessage("§aYou did not enter a valid amount");
                return true;
            }
            if ($data[1] <= 0) {
                $player->sendMessage("§aYou must enter an amount greater than 0");
                return true;
            }

            if ($action == 0) {
                $this->addMoney($target, (float) $data[1]);
                $player->sendMessage("§aYou have added $" . $data[1] . " into " . $target . "'s bank");
                $this->addTransaction($target, "§aAdmin added $" . $data[1]);
            }
            if ($action == 1) {
                $this->takeMoney($target, (float) $data[1]);
                $player->sendMessage("§aYou have took $" . $data[1] . " into " . $target . "'s bank");
                $this->addTransaction($target, "§aAdmin took $" . $data[1]);
            }
            if ($action == 2) {
                $this->setMoney($target, (float) $data[1]);
                $player->sendMessage("§aYou have set " . $target . "'s bank balance to $" . $data[1]);
                $this->addTransaction($target, "§aAdmin set balance to $" . $data[1]);
            }
        });

        $form->setTitle("§l" . $target . "'s Bank");;
        $form->addLabel("Balance: $" . $this->getMoney($target));
        if ($action == 0) {
            $form->addInput("§rEnter amount to give", "100000");
        }
        if ($action == 1) {
            $form->addInput("§rEnter amount to take", "100000");
        }
        if ($action == 2) {
            $form->addInput("§rEnter amount to set", "100000");
        }
        $player->sendForm($form);
        return $form;
    }


    public function withdrawForm(Player $player): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    if ($this->getMoney($player->getName()) == 0) {
                        $player->sendMessage("§aYou have no money in the bank to withdraw");
                        return true;
                    }
                    EconomyAPI::getInstance()->addMoney($player->getName(), $this->getMoney($player->getName()));
                    $player->sendMessage("§aYou have withdrew $" . $this->getMoney($player->getName()) . " from the bank");
                    $this->addTransaction($player->getName(), "§aWithdrew $" . $this->getMoney($player->getName()));
                    $this->takeMoney($player->getName(), $this->getMoney($player->getName()));
                    break;
                case 1:
                    if ($this->getMoney($player->getName()) == 0) {
                        $player->sendMessage("§aYou have no money in the bank to withdraw");
                        return true;
                    }
                    EconomyAPI::getInstance()->addMoney($player->getName(), $this->getMoney($player->getName()) / 2);
                    $player->sendMessage("§aYou have withdrew $" . $this->getMoney($player->getName()) / 2 . " from the bank");
                    $this->addTransaction($player->getName(), "§aWithdrew $" . $this->getMoney($player->getName()) / 2);
                    $this->takeMoney($player->getName(), $this->getMoney($player->getName()) / 2);
                    break;
                case 2:
                    $this->withdrawCustomForm($player);
            }
        });
        $form->setTitle("§6»§2WITHDRAW MENU§6«");
        $form->setContent("§bBank Balance: §e$ " . $this->getMoney($player->getName()));
        $form->addButton("§6» §2Withdraw All §6«\n§8Click To Withdraw", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§6» §2Withdraw Half §6«\n§8Click To Withdraw", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§6» §2Withdraw Custom §6«\n§8Click To Withdraw", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $player->sendForm($form);
        return $form;
    }

    public function withdrawCustomForm(Player $player): Form
    {
        $form = new CustomForm(function (Player $player, $data) {
            if ($data === null) {
                return true;
            }

            if ($this->getMoney($player->getName()) == 0) {
                $player->sendMessage("§aYou have no money in the bank to withdraw");
                return true;
            }
            if ($this->getMoney($player->getName()) < $data[1]) {
                $player->sendMessage("§aYou do not have enough money in your bank to withdraw $" . $data[1]);
                return true;
            }
            if (!is_numeric($data[1])) {
                $player->sendMessage("§aYou did not enter a valid amount");
                return true;
            }
            if ($data[1] <= 0) {
                $player->sendMessage("§aYou must enter an amount greater than 0");
                return true;
            }
            EconomyAPI::getInstance()->addMoney($player->getName(), (float) $data[1]);
            $player->sendMessage("§aYou have withdrew $" . $data[1] . " from the bank");
            $this->addTransaction($player->getName(), "§aWithdrew $" . $data[1]);
            $this->takeMoney($player->getName(), (float) $data[1]);
        });

        $form->setTitle("§lWithdraw Menu");
        $form->addLabel("Balance: $" . $this->getMoney($player->getName()));
        $form->addInput("§rEnter amount to withdraw", "100000");
        $player->sendForm($form);
        return $form;
    }

    public function depositForm(Player $player): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $playerMoney = EconomyAPI::getInstance()->myMoney($player);
                    if (is_bool($playerMoney) || $playerMoney <= 0) {
                        $player->sendMessage("§aYou do not have enough money to deposit into the bank");
                        return true;
                    }
                    if ($playerMoney >= 100000000) {
                        $player->sendMessage("§aYou can't deposit more than 100 million");
                        return true;
                    }
                    $this->addTransaction($player->getName(), "§aDeposited $" . $playerMoney);
                    $this->addMoney($player->getName(), $playerMoney);
                    $player->sendMessage("§aYou have deposited $" . $playerMoney . " into the bank");
                    EconomyAPI::getInstance()->reduceMoney($player, $playerMoney);
                    if ($this->getConfig()->get("log-player-webhook") === true){
                      if ($this->getMoney($player->getName()) >= 50000000){
                          $this->sendDiscord($player->getName(), $this->getMoney($player->getName()));
                      }
                    }
                    break;
                case 1:
                    $playerMoney = EconomyAPI::getInstance()->myMoney($player);
                    if (is_bool($playerMoney) || $playerMoney <= 0) {
                        $player->sendMessage("§aYou do not have enough money to deposit into the bank");
                        return true;
                    }
                    if ($playerMoney / 2 >= 100000000) {
                        $player->sendMessage("§aYou can't deposit more than 100 million");
                        return true;
                    }
                    $this->addTransaction($player->getName(), "§aDeposited $" . $playerMoney / 2);
                    $this->addMoney($player->getName(), $playerMoney / 2);
                    $player->sendMessage("§aYou have deposited $" . $playerMoney / 2 . " into the bank");
                    EconomyAPI::getInstance()->reduceMoney($player, $playerMoney / 2);
                    if ($this->getConfig()->get("log-player-webhook") === true){
                      if ($this->getMoney($player->getName()) >= 50000000){
                          $this->sendDiscord($player->getName(), $this->getMoney($player->getName()));
                      }
                    }
                    break;
                case 2:
                    $this->depositCustomForm($player);
            }
        });
        $form->setTitle("§lDeposit Menu");
        $form->setContent("§bBank Balance: §e$" . $this->getMoney($player->getName()));
        $form->addButton("§6» §2Deposit All §6«\n§8Click To Deposit", 1, "https://cdn-icons-png.flaticon.com/128/1041/1041888.png");
        $form->addButton("§6» §2Deposit Half §6«\n§8Click To Deposit", 1, "https://cdn-icons-png.flaticon.com/128/1041/1041888.png");
        $form->addButton("§6» §2Deposit Custom §6«\n§8Click To Deposit", 1, "https://cdn-icons-png.flaticon.com/128/1041/1041888.png");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $player->sendForm($form);
        return $form;
    }

    public function depositCustomForm(Player $player): Form
    {
        $form = new CustomForm(function (Player $player, $data) {
            if ($data === null) {
                return true;
            }
            $playerMoney = EconomyAPI::getInstance()->myMoney($player);
            if ($playerMoney < $data[1]) {
                $player->sendMessage("§aYou do not have enough money to deposit $" . $data[1] . " into the bank");
                return true;
            }
            if (!is_numeric($data[1])) {
                $player->sendMessage("§aYou did not enter a valid amount");
                return true;
            }
            if ($data[1] <= 0) {
                $player->sendMessage("§aYou must enter an amount greater than 0");
                return true;
            }
            if ($data[1] >= 100000000) {
                        $player->sendMessage("§aYou can't deposit more than 100 million");
                        return true;
                    }
            $player->sendMessage("§aYou have deposited $" . $data[1] . " into the bank");
            $this->addTransaction($player->getName(), "§aDeposited $" . $data[1]);
            $this->addMoney($player->getName(), (float) $data[1]);
            EconomyAPI::getInstance()->reduceMoney($player, (float) $data[1]);
            if ($this->getConfig()->get("log-player-webhook") === true){
                      if ($this->getMoney($player->getName()) >= 50000000){
                          $this->sendDiscord($player->getName(), $this->getMoney($player->getName()));
                }
            }
        });

        $form->setTitle("§lDeposit Menu");
        $form->addLabel("Balance: $" . $this->getMoney($player->getName()));
        $form->addInput("§rEnter amount to deposit", "100000");
        $player->sendForm($form);
        return $form;
    }

    public function transferCustomForm(Player $player): Form
    {
        $list = [];
        foreach ($this->getServer()->getOnlinePlayers() as $players) {
            if ($players->getName() !== $player->getName()) {
                $list[] = $players->getName();
            }
        }

        $form = new CustomForm(function (Player $player, $data) use ($list) {
            if ($data === null) {
                return true;
            }

            if (!isset($list[$data[1]])) {
                $player->sendMessage("§aYou must select a valid player");
                return true;
            }

            $index = $data[1];
            $playerName = $list[$index];

            if ($this->getMoney($player->getName()) == 0) {
                $player->sendMessage("§aYou have no money in the bank to transfer money");
                return true;
            }
            if ($this->getMoney($player->getName()) < $data[2]) {
                $player->sendMessage("§aYou do not have enough money in your bank to transfer $" . $data[2]);
                return true;
            }
            if (!is_numeric($data[2])) {
                $player->sendMessage("§aYou did not enter a valid amount");
                return true;
            }
            if ($data[2] <= 0) {
                $player->sendMessage("§aYou must transfer at least $1");
                return true;
            }
            $player->sendMessage("§aYou have transferred $" . $data[2] . " into " . $playerName . "'s bank account");
            if (!$this->getServer()->getPlayerExact($playerName)) {
                return true;
            }
            $otherPlayer = $this->getServer()->getPlayerExact($playerName);
            $otherPlayer->sendMessage("§a" . $player->getName() . " has transferred $" . $data[2] . " into your bank account");
            $this->addTransaction($player->getName(), "§aTransferred $" . $data[2] . " into " . $playerName . "'s bank account");
            $this->takeMoney($player->getName(), (float) $data[2]);
            $this->addMoney($otherPlayer->getName(), (float) $data[2]);
        });

        $form->setTitle("§lTransfer Menu");
        $form->addLabel("Balance: $" . $this->getMoney($player->getName()));
        $form->addDropdown("Select a Player", $list);
        $form->addInput("§rEnter amount to transfer", "100000");
        $player->sendForm($form);
        return $form;
    }

    public function transactionsForm(Player $player): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
        });

        $form->setTitle("§6»§2TRANSACTION MENU§6«");
        if (!isset($this->playersTransactions[$player->getName()]) || $this->playersTransactions[$player->getName()] === 0) {
            $form->setContent("You have not made any transactions yet");
        } else {
            $form->setContent($this->playersTransactions[$player->getName()]);
        }
        $form->addButton("§l§cEXIT\n§r§dClick to close...", 0, "textures/ui/cancel");
        $player->sendForm($form);
        return $form;
    }

    public function otherTransactionsForm(Player $sender, string $player): Form
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
        });

        $form->setTitle("§l" . $player . "'s Transactions");
        if ($this->getServer()->getPlayerExact($player) instanceof Player) {
            if (!isset($this->playersTransactions[$player]) || $this->playersTransactions[$player] === 0) {
                $form->setContent($player . " has not made any transactions yet");
            } else {
                $form->setContent($this->playersTransactions[$player]);
            }
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            if ($playerBankMoney->get('Transactions') === 0) {
                $form->setContent($player . " has not made any transactions yet");
            } else {
                $form->setContent($playerBankMoney->get('Transactions'));
            }
            $playerBankMoney->save();
        }
        $form->addButton("§l§cEXIT\n§r§dClick to close...", 0, "textures/ui/cancel");
        $sender->sendForm($form);
        return $form;
    }

    public function addMoney(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player]) && is_numeric($this->playersMoney[$player])) {
            $this->playersMoney[$player] = $this->playersMoney[$player] + $amount;
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $playerBankMoney->get("Money") + $amount);
            $playerBankMoney->save();
        }
    }

    public function takeMoney(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player])) {
            $this->playersMoney[$player] = $this->playersMoney[$player] - $amount;
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $playerBankMoney->get("Money") - $amount);
            $playerBankMoney->save();
        }
    }
    
    /*public function takeMoney(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player])) {
            $this->playersMoney[$player] = $this->playersMoney[$player] - $amount;
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $playerBankMoney->get("Money") - $amount);
            $playerBankMoney->save();
        }
      }*/
        
    public function sendDiscord(string $player, float $amount): void
    {
        /*if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player])) {*/
            $web = new Webhook($this->getConfig()->get("log-webhook-url"));
            $colorval = hexdec($this->getConfig()->get("log-embed-color"));
            $msg = new Message();
            $msg->setUsername($this->getConfig()->get("log-webhook-username"));
  		    	$msg->setAvatarURL($this->getConfig()->get("log-webhook-avatar-url"));
            $e = new Embed();
            $e->setColor($colorval);
            $e->setTitle("BANK LOG 💰");
            $e->addField("Player Name", $player);
            $e->addField("Money In Bank", $amount);
            $e->setThumbnail($this->getConfig()->get("log-thumbnail-url"));
            $msg->addEmbed($e);
            $web->send($msg);
        
    }

    public function setMoney(string $player, float $amount): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player])) {
            $this->playersMoney[$player] = $amount;
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $amount);
            $playerBankMoney->save();
        }
    }

    public function getMoney(string $player): float
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersMoney[$player])) {
            return (float) $this->playersMoney[$player];
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $money = (float) $playerBankMoney->get("Money");
            $playerBankMoney->save();
            return $money;
        }
    }

    public function addTransaction(string $player, string $message): void
    {
        if ($this->getServer()->getPlayerExact($player) instanceof Player && isset($this->playersTransactions[$player])) {
            if ($this->playersTransactions[$player] === 0) {
                $this->playersTransactions[$player] = date("§b[d/m/y]") . "§e - " . $message . "\n";
            } else {
                $this->playersTransactions[$player] = date("§b[d/m/y]") . "§e - " . $message . "\n" . $this->playersTransactions[$player];
            }
        } else {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            if ($playerBankMoney->get('Transactions') === 0) {
                $playerBankMoney->set('Transactions', date("§b[d/m/y]") . "§e - " . $message . "\n");
            } else {
                $playerBankMoney->set('Transactions', date("§b[d/m/y]") . "§e - " . $message . "\n" . $playerBankMoney->get('Transactions'));
            }
            $playerBankMoney->save();
        }
    }

    public function saveData(Player $player): void
    {
        if (isset($this->playersMoney[$player->getName()])) {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $this->playersMoney[$player->getName()]);
            $playerBankMoney->set("Transactions", $this->playersTransactions[$player->getName()]);
            $playerBankMoney->save();
        }
    }

    public function saveAllData(): void
    {
        foreach ($this->playersMoney as $player => $amount) {
            $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankMoney->set("Money", $amount);
            $playerBankMoney->save();
        }
        foreach ($this->playersTransactions as $player => $amount) {
            $playerBankTransactions = new Config($this->getDataFolder() . "Players/" . $player . ".yml", Config::YAML);
            $playerBankTransactions->set("Transactions", $this->playersTransactions[$player]);
            $playerBankTransactions->save();
        }
    }

    public function loadData(Player $player): void
    {
        $playerBankMoney = new Config($this->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML);
        $this->playersMoney[$player->getName()] = $playerBankMoney->get("Money");
        $this->playersTransactions[$player->getName()] = $playerBankMoney->get("Transactions");
    }

    public function notesForm(Player $player): Form
    {
        $form = new CustomForm(function (Player $player, $data) {
            if ($data === null) {
                return true;
            }

            if ($this->getMoney($player->getName()) == 0) {
                $player->sendMessage("§aYou have no money in the purse to make note");
                return true;
            }
            if ($this->getMoney($player->getName()) < $data[1]) {
                $player->sendMessage("§aYou do not have enough money in your bank to make note");
                return true;
            }
            if (!is_numeric($data[1])) {
                $player->sendMessage("§aYou did not enter a valid amount");
                return true;
            }
            if ($data[1] <= 0) {
                $player->sendMessage("§aYou must enter an amount greater than 0");
                return true;
            }
            if ($data[1] > 5000000) {
                $player->sendMessage("§aYou can't make bank note of over 5 million");
                return true;
            }
            $name = $player->getName();
            $this->takeMoney($player->getName(), (float) $data[1]);
            $item = ItemFactory::getInstance()->get(1091, 0, 1);
            $item->setCustomName("§r§l§6$" . $data[1] . " §aBANK NOTE");
            $item->setLore(["§r§7Right Click To Redeem This §aBanknote§7\n§r§7Withdrawn By §f$name\n\n§r§7Value » §a$" . $data[1] . ""]);
            $item->getNamedTag()->setString("Amount", (string) $data[1]);
            $player->getInventory()->addItem($item);
            $this->addTransaction($player->getName(), "§aWithdrew Bank Note $" . $data[1]);
        });
        $form->setTitle("§6»§2NOTES§6«");
        $form->addLabel("§bMoney Will be Deducted From Your Bank\n\n§aBank Balance: §e$" . $this->getMoney($player->getName()) . "");
        $form->addInput("§rEnter Amount", "1000");
        $player->sendForm($form);
        return $form;
    }

    public function onInteract(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if (!$item->getNamedTag()->getTag("Amount")) {
            return;
        }

        $item->setCount($item->getCount() - 1);
        $player->getInventory()->setItemInHand($item);
        EconomyAPI::getInstance()->addMoney($player, (float) $item->getNamedTag()->getString("Amount"));
        $player->sendMessage(" §7You Have Claimed §e$" . $item->getNamedTag()->getString("Amount") . "§7 Note!");
    }
}
