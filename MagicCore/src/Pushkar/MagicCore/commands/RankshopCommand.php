<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class RankshopCommand extends Command
{
    public function __construct()
    {
        parent::__construct("rankshop", "§eServer Rankshop");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            $sender->sendMessage(" §eNo RankShop Will Be Opened In Beta Server");
            return true;
        }
        return false;
    }
}
