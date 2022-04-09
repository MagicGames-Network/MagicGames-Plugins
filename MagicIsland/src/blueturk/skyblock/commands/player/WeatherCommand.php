<?php


namespace blueturk\skyblock\commands\player;


use blueturk\skyblock\forms\island\WeatherSettingsForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class WeatherCommand extends Command
{

    public function __construct()
    {
        parent::__construct("weather", "§bChange the weather of the island!", "/weather", ["weather forecast"]);
        $this->setPermission("weather.command.bt");
        $this->setPermissionMessage("§8» §7This command is only for VIP users!");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if ($sender->hasPermission("weather.command.bt")){
                $sender->sendForm(new WeatherSettingsForm());
            }else{
                $sender->sendMessage($this->getPermissionMessage());
            }
        }
    }
}