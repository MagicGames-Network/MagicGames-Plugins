<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class ServersForm extends MenuForm
{

    public function __construct(Player $sender)
    {
      $name = $sender->getName();
        parent::__construct("§l§cSERVERS","§bHi §e$name ,\n\n§eMagic§6Games§b Provide Many Minigames\n§bHere Are Some Listed Below:",[
            new MenuOption("§6» §2SURVIVAL SMP §6«\n§8Click To Transfer", new FormIcon("textures/icon/survival", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§cExit", new FormIcon("textures/blocks/barrier", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void{
            switch ($selected){
                case 0:
       $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("survivalserver.cmd")));
       $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
         break;
            }
        });
    }

}