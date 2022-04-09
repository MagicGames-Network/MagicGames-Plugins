<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class RepairCommand extends Command
{

    public function __construct()
    {
        parent::__construct("repair","§eRepair Your Items");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            $item = $sender->getInventory()->getItemInHand();
        		$item->setDamage(0);
            $sender->getInventory()->setItemInHand($item);
            $sender->sendMessage ("§e§lMAGICGAMES > §r§bRepaired Your Item");
        } else {
            $sender->sendMessage("Use this command in-game");
        }
    }
}