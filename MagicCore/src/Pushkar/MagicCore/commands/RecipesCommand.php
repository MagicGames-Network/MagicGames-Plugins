<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\RecipesForm;

class RecipesCommand extends Command
{

    public function __construct()
    {
        parent::__construct("recipes","§eSee Custom Recipes");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            (new RecipesForm($this))->cui($sender);
        }
    }

}