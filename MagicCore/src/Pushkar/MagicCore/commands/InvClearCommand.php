<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\InvclearForm;

class InvClearCommand extends Command
{

    public function __construct()
    {
        parent::__construct("invclear","§eClear Your Inventory");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            $sender->sendForm(new InvclearForm());
        }
    }

}