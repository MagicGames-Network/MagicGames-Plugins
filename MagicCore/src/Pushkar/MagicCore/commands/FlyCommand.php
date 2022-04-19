<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class FlyCommand extends Command
{
    private array $fly;

    public function __construct()
    {
        parent::__construct("fly", "§eFly In Air Lol");
        $this->setPermission("fly.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
          if ($sender->hasPermission("fly.cmd")){
            if (isset($this->fly[$sender->getName()])) {
                unset($this->fly[$sender->getName()]);
                $sender->setFlying(false);
                $sender->sendMessage("§l§eMAGICGAMES > §r§bFlying Disabled");
                return true;
            }
            $this->fly[$sender->getName()] = 0;
            $sender->setFlying(true);
            $sender->sendMessage("§l§eMAGICGAMES > §r§bFlying Enabled");
          } else {
            $sender->sendMessage(Main::PREFIX . "You Don't Have Permission");
          }
          return true;
        }
        return false;
    }
}
