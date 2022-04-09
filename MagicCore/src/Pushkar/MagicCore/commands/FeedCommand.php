<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\Main;

class FeedCommand extends Command
{

    public function __construct()
    {
        parent::__construct("feed","§eFill your hunger bar");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            $sender->getHungerManager()->setFood(20);
            $sender->getHungerManager()->setSaturation(20);
            $sender->sendMessage(Main::PREFIX . "Gods Feeded You");
        } else {
            $sender->sendMessage("Use this command in-game");
        }
    }

}