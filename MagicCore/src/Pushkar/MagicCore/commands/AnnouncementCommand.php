<?php

namespace Pushkar\MagicCore\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Pushkar\MagicCore\forms\InformationForm;

class AnnouncementCommand extends Command
{

    public function __construct()
    {
        parent::__construct("announcement","§eSee Server Announcement");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ($sender instanceof Player){
            (new InformationForm($this))->INFONINE($sender);
        }
    }

}