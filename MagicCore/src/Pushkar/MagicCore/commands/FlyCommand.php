<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\Server;
use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

class FlyCommand extends Command
{

    public function __construct()
    {
        parent::__construct("fly", "§eFly :D");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(Main::PREFIX . "Use this command in-game");
        }
        if (!$sender->hasPermission("fly.cmd")) {
            $sender->sendMessage(Main::PREFIX . "You do not have permission to use this command");
        }
        if ($sender instanceof Player) {
            if (empty($args[0])) {
                if (!$sender->isCreative()) {
                    $sender->sendMessage($sender->getAllowFlight() === false ? Main::getInstance()->getConfig()->get("fly-enabled") : Main::getInstance()->getConfig()->get("fly-disabled"));
                    $sender->setAllowFlight($sender->getAllowFlight() === false);
                    if ($sender->getAllowFlight() === false && $sender->isFlying()) $sender->setFlying(false);
                } else {
                    $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You can only use this command in survival mode");
                }
            }
            if (!$sender->hasPermission("fly.other.cmd")) {
                $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You do not have permission to enable flight for others");
            }
            if (Server::getInstance()->getPlayerByPrefix($args[0])) {
                $sender = Server::getInstance()->getPlayerByPrefix($args[0]);
                if (!$sender->isCreative()) {
                    $sender->sendMessage($sender->getAllowFlight() === false ? Main::getInstance()->getConfig()->get("fly-enabled") : Main::getInstance()->getConfig()->get("fly-disabled"));
                    $sender->sendMessage($sender->getAllowFlight() === false ? Main::PREFIX . TextFormat::GREEN . "You have enabled fly for " . $sender->getName() : Main::PREFIX . TextFormat::RED . "You have disabled fly for " . $sender->getName());
                    $sender->setAllowFlight($sender->getAllowFlight() === false);
                    if ($sender->getAllowFlight() === false && $sender->isFlying()) $sender->setFlying(false);
                } else {
                    $sender->sendMessage(Main::PREFIX . TextFormat::RED . $sender->getName() . " is in creative mode");
                }
            } else {
                $sender->sendMessage(Main::PREFIX . TextFormat::RED . "Player not found");
            }
        }
    }
}
