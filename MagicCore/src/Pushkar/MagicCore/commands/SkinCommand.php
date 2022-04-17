<?php

namespace Pushkar\MagicCore\commands;

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
            //$sender->sendForm(new SkinForm($sender));
            return true;
        }
        return false;
    }
}
