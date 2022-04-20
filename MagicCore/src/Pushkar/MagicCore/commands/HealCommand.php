<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class HealCommand extends Command
{
    public function __construct()
    {
        parent::__construct("heal", "§eFill your health bar");
        $this->setPermission("heal.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            if ($sender->hasPermission("fly.cmd")) {
                $sender->setHealth(20);
                $sender->sendMessage(Main::PREFIX . "Gods Healed You");
            } else {
                $sender->sendMessage(Main::PREFIX . "You Don't Have Permission");
            }
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
