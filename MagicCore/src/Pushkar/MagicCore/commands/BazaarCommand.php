<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\BazaarForm;

class BazaarCommand extends Command
{

    public function __construct()
    {
        parent::__construct("bazaar", "§eSell Items In Bazaar");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new BazaarForm());
            return;
        }
        $sender->sendMessage("Use this command in-game");
    }
}
