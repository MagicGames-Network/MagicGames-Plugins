<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\SettingsForm;

class SettingsCommand extends Command
{

    public function __construct()
    {
        parent::__construct("settings","§eYour Personal Settings");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            $sender->sendForm(new SettingsForm());
        }
    }

}