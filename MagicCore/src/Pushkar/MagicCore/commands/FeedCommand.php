<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class FeedCommand extends Command
{
    public function __construct()
    {
        parent::__construct("feed", "§eFill your hunger bar");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            $sender->getHungerManager()->setFood(20);
            $sender->getHungerManager()->setSaturation(20);
            $sender->sendMessage(Main::PREFIX . "Gods Feeded You");
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
