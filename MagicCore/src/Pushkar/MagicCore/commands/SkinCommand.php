<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\SkinForm;

class SkinCommand extends Command
{

    public function __construct()
    {
        parent::__construct("skin","§eSkin Stealer");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            $sender->sendForm(new SkinForm());
        }
    }

}