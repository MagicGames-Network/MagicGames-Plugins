<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

class VanishCommand extends Command
{
    private array $vanish = [];

    public function __construct()
    {
        parent::__construct("vanish", "§eVanish Command");
        $this->setPermission("vanish.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
          if ($sender->hasPermission("vanish.cmd")){
            if (isset($this->vanish[$sender->getName()])) {
                $sender->sendMessage(TextFormat::GRAY . "You are now vanished.");
                $sender->setInvisible(true);
                unset($this->vanish[$sender->getName()]);
                return true;
            }
            $sender->sendMessage(TextFormat::GRAY . "You are now un vanished.");
            $sender->setInvisible(false);
            $this->vanish[$sender->getName()] = 1;
        } else {
            $sender->sendMessage(Main::PREFIX . "You Don't Have Permission");
          }
            return true;
        }
        return false;
    }
}
