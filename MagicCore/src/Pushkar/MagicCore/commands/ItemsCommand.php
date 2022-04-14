<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\ItemsForm;

class ItemsCommand extends Command
{
    public function __construct()
    {
        parent::__construct("items", "§eAdmins Items :)");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new ItemsForm());
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
