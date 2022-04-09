<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\ItemsForm;

class ItemsCommand extends Command
{

    public function __construct()
    {
        parent::__construct("items","§eAdmins Items :)");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
           $sender->sendForm(new ItemsForm());
        }else{
            $sender->sendMessage("Use this command in-game");
        }
    }
}