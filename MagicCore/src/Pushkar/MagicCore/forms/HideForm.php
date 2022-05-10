<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use dktapps\pmforms\FormIcon;

class HideForm extends MenuForm
{

    public $hidePlayer = [];

    public function __construct(Player $player)
    {
        parent::__construct(
            "§l§6Player Hide",
            "§bPlayer Hide / Un Hide\n\n§bThis Feature Will Reduce Lag On Player Device\n\n§a(§cNote:§a This Function Is Still In Beta You May Can Get Error)",
            [
                new MenuOption("§bHide", new FormIcon("textures/icon/star", FormIcon::IMAGE_TYPE_URL)),
                new MenuOption("§bUnhide", new FormIcon("textures/icon/star", FormIcon::IMAGE_TYPE_URL))
                
            ],
            function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
    					  	foreach(Server::getInstance()->getOnlinePlayers() as $players) {
    								if($players instanceof Player){
    									$sender->hidePlayer($players);
    									$sender->sendTitle("§6Done! ", "§eAll Players Are Now Hidden");// Hidden
                     }
    					  	}
    						break;
    						case 1:
    							foreach(Server::getInstance()->getOnlinePlayers() as $players) {
    								if($players instanceof Player){
    									$sender->showPlayer($players);
    									$sender->sendTitle("§6Done! ", "§eAll Players Are Now Showing");// Showing
    						   		}
    							}
                break;
            }
        });
    }
}

