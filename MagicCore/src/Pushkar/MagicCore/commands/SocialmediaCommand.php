<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\InformationForm;

class SocialmediaCommand extends Command
{

    public function __construct()
    {
        parent::__construct("socialmedia","§eServer Social Media");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            (new Information($this))->INFOEIGHT($sender);
        }
    }

}