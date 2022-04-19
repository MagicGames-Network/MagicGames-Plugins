<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class SkinCommand extends Command
{

    public function __construct()
    {
        parent::__construct("skin", "§eSkin Stealer");
        $this->setPermission("skin.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
         if ($sender->hasPermission("skin.cmd")){
            //$sender->sendForm(new SkinForm($sender));
        } else {
            $sender->sendMessage(Main::PREFIX . "You Don't Have Permission");
          }
            return true;
        }
        return false;
    }
}
