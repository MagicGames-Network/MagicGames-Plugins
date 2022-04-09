<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\ServersForm;

class ServersCommand extends Command
{

    public function __construct()
    {
        parent::__construct("servers", "§eSee MagicGames All Servers");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player) {
            $sender->sendForm(new ServersForm($sender));
        }
    }
}
