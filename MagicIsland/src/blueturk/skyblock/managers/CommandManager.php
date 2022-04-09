<?php


namespace blueturk\skyblock\managers;

use blueturk\skyblock\commands\island\IslandCommand;
use blueturk\skyblock\commands\player\WeatherCommand;
use pocketmine\Server;

class CommandManager
{

    public static function loadCommands(): void
    {
        foreach (self::getCommands() as $index => $command) {
            Server::getInstance()->getCommandMap()->register($index, $command);
        }
    }

    public static function getCommands(): array
    {
        return [
            "island" => new IslandCommand(),
            "weather" => new WeatherCommand()
        ];
    }

    public static function commandsCount(): int
    {
        return count(self::getCommands());
    }
}