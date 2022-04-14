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

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(Main::PREFIX . "Use this command in-game");
            return false;
        }
        if (!$sender->hasPermission("fly.cmd")) {
            $sender->sendMessage(Main::PREFIX . "You do not have permission to use this command");
            return false;
        }

        /** @var string $enabled */
        $enabled = Main::getInstance()->getConfig()->get("fly-enabled");
        /** @var string $disabled */
        $disabled = Main::getInstance()->getConfig()->get("fly-disabled");
        if (!isset($args[0])) {
            if (!$sender->isCreative()) {
                $sender->sendMessage(!$sender->getAllowFlight() ? $enabled : $disabled);
                $sender->setAllowFlight(!$sender->getAllowFlight());
                if (!$sender->getAllowFlight() && $sender->isFlying()) $sender->setFlying(false);
                return true;
            }
            $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You can only use this command in survival mode");
            return false;
        }

        if (!$sender->hasPermission("fly.other.cmd")) {
            $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You do not have permission to enable flight for others");
            return false;
        }
        if (Server::getInstance()->getPlayerByPrefix($args[0])) {
            $sender = Server::getInstance()->getPlayerByPrefix($args[0]);
            if (!$sender->isCreative()) {
                $sender->sendMessage(!$sender->getAllowFlight() ? $enabled : $disabled);
                $sender->sendMessage(!$sender->getAllowFlight() ? Main::PREFIX . TextFormat::GREEN . "You have enabled fly for " . $sender->getName() : Main::PREFIX . TextFormat::RED . "You have disabled fly for " . $sender->getName());
                $sender->setAllowFlight(!$sender->getAllowFlight());
                if (!$sender->getAllowFlight() && $sender->isFlying()) $sender->setFlying(false);
                return true;
            }
            $sender->sendMessage(Main::PREFIX . TextFormat::RED . $sender->getName() . " is in creative mode");
            return false;
        }
        $sender->sendMessage(Main::PREFIX . TextFormat::RED . "Player not found");
        return false;
    }
}
