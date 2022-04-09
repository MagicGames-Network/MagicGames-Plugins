<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class HubCommand extends Command
{

    public function __construct()
    {
        parent::__construct("hub","§eTeleport To Hub");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            $sender->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
            $sender->sendTitle("§6Welcome To Hub", "§eMagic§6Games");
        } else {
            $sender->sendMessage("Use this command in-game");
        }
    }

}