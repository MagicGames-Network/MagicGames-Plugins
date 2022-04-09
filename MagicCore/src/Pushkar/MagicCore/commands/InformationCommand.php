<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\EnchantForm;

class InformationCommand extends Command
{

    public function __construct()
    {
        parent::__construct("information","§eServer Information");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            (new Information($this))->MainMenu($sender);
        }
    }

}