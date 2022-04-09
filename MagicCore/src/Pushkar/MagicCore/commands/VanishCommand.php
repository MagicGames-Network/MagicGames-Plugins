<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

class VanishCommand extends Command
{

    private array $vanish = [];

    public function __construct()
    {
        parent::__construct("vanish", "§eVanish Command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (isset($this->vanish[$sender->getName()])) {
                $sender->sendMessage(TextFormat::GRAY . "You are now vanished.");
                $sender->setInvisible(true);
                unset($this->vanish[$sender->getName()]);
            } else {
                $sender->sendMessage(TextFormat::GRAY . "You are now un vanished.");
                $sender->setInvisible(false);
                $this->vanish[$sender->getName()] = 1;
            }
        }
    }
}
