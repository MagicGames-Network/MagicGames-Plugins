<?php

namespace blueturk\skyblock\commands\island;

use pocketmine\player\Player;
use blueturk\skyblock\SkyBlock;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use blueturk\skyblock\forms\island\NoIslandForm;
use blueturk\skyblock\forms\island\IslandOptionsForm;

class IslandCommand extends Command
{
    public function __construct()
    {
        parent::__construct("island", "§bOpens the island screen!", "/island", ["island", "is", "sb"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $data = SkyBlock::getInstance()->getConfig();
            if ($data->getNested($sender->getName() . "." . "island") !== null) {
                $sender->sendForm(new IslandOptionsForm($sender));
                return;
            }
            $sender->sendForm(new NoIslandForm());
        }
    }
}
