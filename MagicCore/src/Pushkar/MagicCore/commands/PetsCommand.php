<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\MagicCore;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\PetsForm;

class PetsCommand extends Command
{
    public function __construct()
    {
        parent::__construct("pets", "§ePets");
        $this->setPermission("pets.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
          if ($sender->hasPermission("pets.cmd")){
            $sender->sendForm(new PetsForm($sender));
          } else {
            $sender->sendMessage(MagicCore::PREFIX . "You Don't Have Permission");
          }
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
