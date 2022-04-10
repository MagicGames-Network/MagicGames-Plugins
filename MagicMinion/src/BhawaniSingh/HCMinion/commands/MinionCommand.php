<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\commands;

use CortexPE\Commando\BaseCommand;
use BhawaniSingh\HCMinion\commands\subcommands\GiveCommand;
use BhawaniSingh\HCMinion\commands\subcommands\RemoveCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MinionCommand extends BaseCommand
{
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if ($sender instanceof Player && !$sender->hasPermission($this->getPermission())) {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command!");

            return;
        }
        $this->sendUsage();
    }

    protected function prepare(): void
    {
        $this->registerSubCommand(new GiveCommand('give', 'Give you a minion spawner'));
        $this->registerSubCommand(new RemoveCommand('remove', 'Quickly remove minions'));
        $this->setPermission('minion.commands');
        $this->setUsage('/minion give|remove');
    }
}
