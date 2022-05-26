<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use Pushkar\MagicCore\forms\TradeForm;
use Pushkar\MagicCore\forms\InformationForm;

class JerryForm extends MenuForm
{

    public function __construct(Player $sender)
    {
        $name = $sender->getName();
        parent::__construct("is_dynamic&side_text§eMAGICGAMES JERRY", "§bHello,\n§e$name\n\n\n§bWelcome To Your Personal Skyblock Assistant\n\n§bYou Can Teleport Jerry With The Help Of Skyblock Menu", [
            new MenuOption("grid_tile§eSKYBLOCK MENU", new FormIcon("https://cdn-icons-png.flaticon.com/128/619/619005.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eSHOP", new FormIcon("https://cdn-icons-png.flaticon.com/128/1198/1198310.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eTELEPORT TO HUB", new FormIcon("https://i.imgur.com/hoWiSas.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eQUEST", new FormIcon("https://cdn-icons-png.flaticon.com/128/1673/1673620.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eWARPS", new FormIcon("https://i.imgur.com/9bVt5M1.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§ePROFILE", new FormIcon("https://i.imgur.com/hBhDETp.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eJERRY TRADE", new FormIcon("https://i.imgur.com/7N7sUzQ.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eAUCTION", new FormIcon("https://cdn-icons-png.flaticon.com/512/2863/2863339.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eANNOUNCEMENT", new FormIcon("https://i.imgur.com/XNl95R5.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eCHANGELOG", new FormIcon("https://i.imgur.com/UQvACCH.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eJERRY SETTINGS", new FormIcon("https://i.pinimg.com/originals/6d/71/eb/6d71eb4e2987eee7b11718ddf97bf297.jpg", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eSOCIAL MEDIA", new FormIcon("https://i.imgur.com/2jjvcKo.png", FormIcon::IMAGE_TYPE_URL)),
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "sb");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "shop");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "hub");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "quest");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "warp");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "profile");
                    break;
                case 6:
                    $sender->sendForm(new TradeForm());
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "ah");
                    break;
                case 8:
                    (new InformationForm())->INFONINE($sender);
                    break;
                case 9:
                    (new InformationForm())->INFOTWO($sender);
                    break;
                case 10:
                    $sender->sendTitle("Comming Soon");
                    break;
                case 11:
                    (new InformationForm())->INFOEIGHT($sender);
                    break;
            }
        });
    }
}
