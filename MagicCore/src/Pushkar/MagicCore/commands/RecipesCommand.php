<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\RecipesForm;

class RecipesCommand extends Command
{

    public function __construct()
    {
        parent::__construct("recipes", "§eSee Custom Recipes");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new RecipesForm($sender));
        }
    }
}
