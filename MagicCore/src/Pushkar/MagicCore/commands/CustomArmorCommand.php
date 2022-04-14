<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\CustomArmorForm;

class CustomArmorCommand extends Command
{
    public function __construct()
    {
        parent::__construct("caui", "§eCustom Armor");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): mixed
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new CustomArmorForm());
            return true;
        }
        $sender->sendMessage("Use this command in-game");
        return false;
    }
}
