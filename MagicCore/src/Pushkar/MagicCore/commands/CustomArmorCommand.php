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

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new CustomArmorForm());
            return;
        }
        $sender->sendMessage("Use this command in-game");
    }
}
