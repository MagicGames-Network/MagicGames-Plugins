<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;

class SpeedCommand extends Command
{
    private array $speed;

    public function __construct()
    {
        parent::__construct("speed", "§eGet Speed :D");
    }


    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (isset($this->speed[$sender->getName()])) {
                unset($this->speed[$sender->getName()]);
                $sender->getEffects()->remove(VanillaEffects::SPEED());
                $sender->sendMessage("§aSpeed: Off");
                return;
            }
            $this->speed[$sender->getName()] = 0;
            $sender->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), 600 * 100, 3));
            $sender->sendMessage("§aSpeed: On");
        }
    }
}
