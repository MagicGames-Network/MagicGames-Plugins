<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\EnchantForm;

class EnchantCommand extends Command
{

    public function __construct()
    {
        parent::__construct("enchantui","§eSee Enchantment UI");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            $sender->sendForm(new EnchantForm());
        }
    }

}