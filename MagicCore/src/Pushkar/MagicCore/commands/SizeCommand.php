<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\SizeForm;

class SizeCommand extends Command
{
    public function __construct()
    {
        parent::__construct("size", "§eYour sizes");
        $this->setPermission("size.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new SizeForm($sender));
            return true;
        }
        return false;
    }
}
