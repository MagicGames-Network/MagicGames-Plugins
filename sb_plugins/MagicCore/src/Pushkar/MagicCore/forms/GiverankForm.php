<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use Pushkar\MagicCore\MagicCore;
use jojoe77777\FormAPI\CustomForm;
use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;
use Pushkar\MagicCore\utils\Configuration;
use pocketmine\console\ConsoleCommandSender;

class GiverankForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eGive Rank", "§6Select Which Type Of Rank You Want To Give", [
            new MenuOption("§l§bYOUTUBE", new FormIcon("https://cdn-icons-png.flaticon.com/128/1383/1383260.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§bONE BOOSTER", new FormIcon("https://cdn-icons-png.flaticon.com/128/2285/2285537.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§bDOUBLE BOOSTER", new FormIcon("https://cdn-icons-png.flaticon.com/128/2285/2285537.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§cREMOVE RANK", new FormIcon("https://cdn-icons-png.flaticon.com/128/1828/1828843.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->ytrank($sender);
                    break;

                case 1:
                    $this->oneboost($sender);
                    break;

                case 2:
                    $this->doubleboost($sender);
                    break;

                case 3:
                    $this->removerank($sender);
                    break;
            }
        });
    }

    public function ytrank(Player $sender): CustomForm
    {
        $form = new CustomForm(function (Player $sender, array $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            if ($result != null) {

                $web = new Webhook(Configuration::$logWebhookUrl);
                $colorval = hexdec("FFBF00");
                $msg = new Message();
                $msg->setUsername("MagicGames-Log");
                $msg->setAvatarURL("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                $e = new Embed();
                $e->setColor((int) $colorval);
                $e->setTitle("YouTube Rank");
                $e->addField("Given By", $sender->getName());
                $e->addField("To", $data[0]);
                $e->setThumbnail("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $data[0], Configuration::$youtubeRankCommand));
                $msg->addEmbed($e);
                $web->send($msg);
                $sender->sendMessage("§e§lMAGICGAMES > §r§bRank Have Been Applied To " . $data[0]);
                return true;
            }
        });
        $name = $sender->getName();
        $form->setTitle("§e§lYouTube Rank");
        $form->addInput("§dHello, §e$name\n\n§dType The Player Name You Want To Give Rank");
        $sender->sendForm($form);
        return $form;
    }

    public function oneboost(Player $sender): CustomForm
    {
        $form = new CustomForm(function (Player $sender, array $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            if ($result != null) {

                $web = new Webhook(Configuration::$logWebhookUrl);
                $colorval = hexdec("FFBF00");
                $msg = new Message();
                $msg->setUsername("MagicGames-Log");
                $msg->setAvatarURL("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                $e = new Embed();
                $e->setColor((int) $colorval);
                $e->setTitle("One Boost Rank");
                $e->addField("Given By", $sender->getName());
                $e->addField("To", $data[0]);
                $e->setThumbnail("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $data[0], Configuration::$boostOneRankCommand));
                $msg->addEmbed($e);
                $web->send($msg);
                $sender->sendMessage("§e§lMAGICGAMES > §r§bRank Have Been Applied To " . $data[0]);
                return true;
            }
        });
        $name = $sender->getName();
        $form->setTitle("§e§lOne Boost Rank");
        $form->addInput("§dHello, §e$name\n\n§dType The Player Name You Want To Give Rank");
        $sender->sendForm($form);
        return $form;
    }

    public function doubleboost(Player $sender): CustomForm
    {
        $form = new CustomForm(function (Player $sender, array $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            if ($result != null) {

                $web = new Webhook(Configuration::$logWebhookUrl);
                $colorval = hexdec("FFBF00");
                $msg = new Message();
                $msg->setUsername("MagicGames-Log");
                $msg->setAvatarURL("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                $e = new Embed();
                $e->setColor((int) $colorval);
                $e->setTitle("Double Boost Rank");
                $e->addField("Given By", $sender->getName());
                $e->addField("To", $data[0]);
                $e->setThumbnail("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $data[0], Configuration::$boostTwoRankCommand));
                $msg->addEmbed($e);
                $web->send($msg);
                $sender->sendMessage("§e§lMAGICGAMES > §r§bRank Have Been Applied To " . $data[0]);
                return true;
            }
        });
        $name = $sender->getName();
        $form->setTitle("§e§lDouble Boost Rank");
        $form->addInput("§dHello, §e$name\n\n§dType The Player Name You Want To Give Rank");
        $sender->sendForm($form);
        return $form;
    }

    public function removerank(Player $sender): CustomForm
    {
        $form = new CustomForm(function (Player $sender, array $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            if ($result != null) {

                $web = new Webhook(Configuration::$logWebhookUrl);
                $colorval = hexdec("FF0000");
                $msg = new Message();
                $msg->setUsername("MagicGames-Log");
                $msg->setAvatarURL("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                $e = new Embed();
                $e->setColor((int) $colorval);
                $e->setTitle("Remove Rank");
                $e->addField("Removed By", $sender->getName());
                $e->addField("From", $data[0]);
                $e->setThumbnail("https://cdn-icons-png.flaticon.com/128/3039/3039367.png");
                Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $data[0], Configuration::$removeRankCommand));
                $msg->addEmbed($e);
                $web->send($msg);
                $sender->sendMessage("§e§lMAGICGAMES > §r§bRemoved Rank Of " . $data[0]);
                return true;
            }
        });
        $name = $sender->getName();
        $form->setTitle("§e§lRemove Rank");
        $form->addInput("§dHello, §e$name\n\n§dType The Player Name You Want To Remove Rank");
        $sender->sendForm($form);
        return $form;
    }
}
