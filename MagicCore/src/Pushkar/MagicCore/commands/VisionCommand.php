<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;

class VisionCommand extends Command
{

    private array $vision;

    public function __construct()
    {
        parent::__construct("vision", "§eGet Vision :D");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (isset($this->vision[$sender->getName()])) {
                unset($this->vision[$sender->getName()]);
                $sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
                $sender->sendMessage("§aVision: Off");
            } else {
                $this->vision[$sender->getName()] = 0;
                $sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 600 * 100, 3));
                $sender->sendMessage("§aVision: On");
            }
        }
    }
}
