<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\SizeForm;

class SizeCommand extends Command
{

    public function __construct()
    {
        parent::__construct("size","§eYour sizes");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            $sender->sendForm(new SizeForm($sender));
        }
    }

}