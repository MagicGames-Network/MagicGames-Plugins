<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\item\Durable;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class RepairCommand extends Command
{

    public function __construct()
    {
        parent::__construct("repair", "§eRepair Your Items");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $item = $sender->getInventory()->getItemInHand();
            if ($item instanceof Durable) {
                $item->setDamage(0);
                $sender->getInventory()->setItemInHand($item);
                $sender->sendMessage("§e§lMAGICGAMES > §r§bRepaired Your Item");
            }
        } else {
            $sender->sendMessage("Use this command in-game");
        }
    }
}
