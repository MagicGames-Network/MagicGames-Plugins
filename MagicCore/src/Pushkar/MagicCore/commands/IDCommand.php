<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\Main;

class IDCommand extends Command
{

    public function __construct()
    {
        parent::__construct("id","§eItem id");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            $sender->sendMessage(Main::PREFIX . "§aID: §9{$sender->getInventory()->getItemInHand()->getId()}:{$sender->getInventory()->getItemInHand()->getMeta()}");
        } else {
            $sender->sendMessage("Use this command in-game");
        }
    }

}