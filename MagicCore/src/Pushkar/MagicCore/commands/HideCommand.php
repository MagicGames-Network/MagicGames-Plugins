<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\HideForm;

class HideCommand extends Command
{

    public function __construct()
    {
        parent::__construct("hide", "§eHide/Show Player");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new HideForm($sender));
            return;
        }
        $sender->sendMessage("Use this command in-game");
    }
}
