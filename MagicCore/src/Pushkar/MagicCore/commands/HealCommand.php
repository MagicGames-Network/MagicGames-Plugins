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
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->setHealth(20);
            $sender->sendMessage(Main::PREFIX . "Gods Healed You");
            return;
        }
        $sender->sendMessage("Use this command in-game");
    }
}
