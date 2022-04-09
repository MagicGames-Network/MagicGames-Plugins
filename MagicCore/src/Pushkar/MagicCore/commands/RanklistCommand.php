<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\EnchantForm;

class RanklistCommand extends Command
{

    public function __construct()
    {
        parent::__construct("ranklist","§eServer Ranks");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            (new Information($this))->INFOSEVEN($sender);
        }
    }

}