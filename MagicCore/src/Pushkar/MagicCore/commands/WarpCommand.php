<?php

namespace Pushkar\MagicCore\commands;

use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Pushkar\MagicCore\forms\WarpForm;

class WarpCommand extends Command
{

    public function __construct()
    {
        parent::__construct("warp", "§eWarpUI For Better Experience");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $sender->sendForm(new WarpForm(Main::getInstance()));
            return;
        }
        $sender->sendMessage("Use this command in-game");
    }
}
