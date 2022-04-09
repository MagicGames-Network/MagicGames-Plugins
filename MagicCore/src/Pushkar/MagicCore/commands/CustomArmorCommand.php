<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\CustomArmorForm;

class CustomArmorCommand extends Command
{

    public function __construct()
    {
        parent::__construct("caui","§eCustom Armor");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            $sender->sendForm(new CustomArmorForm());
        }else{
            $sender->sendMessage("Use this command in-game");
        }
    }

}