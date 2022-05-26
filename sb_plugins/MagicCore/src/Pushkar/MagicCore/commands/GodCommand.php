<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\MagicCore;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class GodCommand extends Command
{
    public function __construct()
    {
        parent::__construct("god", "§eBecome a god :)");
        $this->setPermission("god.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
          if ($sender->hasPermission("god.cmd")){
            $sender->sendMessage(" §cComming Soon");
          } else {
            $sender->sendMessage(MagicCore::PREFIX . "You Don't Have Permission");
          }
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
