<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use pocketmine\console\ConsoleCommandSender;

class ServersForm extends MenuForm
{

    public function __construct(Player $sender)
    {
        $name = $sender->getName();
        parent::__construct("is_dynamic&side_textMAGICGAMES SERVERS", "§bHi §e$name ,\n\n§eMagic§6Games§b Provide Many Minigames\n\n§bHere Are Some Listed Below:", [
            new MenuOption("grid_tileMagicCore Hub", new FormIcon("https://hypixel.net/styles/hypixel-v2/images/game-icons/Arena-64.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tileSkyblock Fire", new FormIcon("https://i.imgur.com/ya7JD0d.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tileSkyblock Ice", new FormIcon("https://i.imgur.com/ya7JD0d.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tileSkyblock Earth", new FormIcon("https://i.imgur.com/ya7JD0d.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tileSURVIVAL SMP", new FormIcon("https://hypixel.net/styles/hypixel-v2/images/game-icons/MurderMystery-64.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("header_button", new FormIcon("textures/ui/icon_back", FormIcon::IMAGE_TYPE_PATH))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), ""));
                    break;
                case 1:
                    $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), ""));
                    break;
                case 2:
                    $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), ""));
                    break;
                case 3:
                    $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), ""));
                    break;
                case 4:
                    $sender->sendTitle("§l§6Transfering", FormIcon::IMAGE_TYPE_URL);
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), ""));
                    break;
                case 5:
                    break;
            }
        });
    }
}
