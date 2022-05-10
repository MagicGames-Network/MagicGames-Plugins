<?php

namespace blueturk\skyblock\commands\island;

use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use blueturk\skyblock\forms\island\IslandVisitAllOpenForm;
use blueturk\skyblock\forms\island\IslandOptionsForm;
use blueturk\skyblock\managers\IslandManager;

class VisitCommand extends Command
{
    public function __construct()
    {
        parent::__construct("visit", "§bVisit Player Island", "/visit {player name}");
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
    		if(isset($args[0])){
    			IslandManager::islandVisit($sender, $args[0]);
    			return;
  	    }
  	    $sender->sendForm(new IslandVisitAllOpenForm());
    }
}
