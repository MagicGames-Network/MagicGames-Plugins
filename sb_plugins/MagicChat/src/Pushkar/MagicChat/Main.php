<?php

namespace Pushkar\MagicChat;

use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener
{
    private array $profanities = [];

    public function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->saveResource("profanity_filter.wlist");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $profanities = file($this->getDataFolder() . "profanity_filter.wlist", FILE_IGNORE_NEW_LINES);
        $this->profanities = !$profanities ? [] : $profanities;

        $cmdMap = $this->getServer()->getCommandMap();
        $pmmpme = $cmdMap->getCommand("me");
        $pmmpme instanceof Command ? $cmdMap->unregister($pmmpme) : null;
    }

    public function onChat(PlayerChatEvent $event): void
    {
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        if (!$player->hasPermission("admin.chat")) {
            if (strlen($event->getMessage()) >= 100) {
                $player->sendMessage(" §cYou Can't Type More Than 100 Letters At Once!");
                $event->cancel();
                return;
            }

            $words = explode(" ", $msg);
            foreach ($words as $word) {
                if (in_array($word, $this->profanities)) {
                    $player->sendMessage(" §cYou Can't Abuse In Chat!");
                    $event->cancel();
                    return;
                }
            }

            $playerChat = $this->getConfig()->get("NonAdminChat");
            foreach ($playerChat as $var) {
                $message = str_replace($var["Before"], $var["After"], $event->getMessage());
                $event->setMessage($message);
            }
        }

        if ($player->hasPermission("emoji.chat")) {
            $textReplacer = $this->getConfig()->get("Emoji");
            foreach ($textReplacer as $var) {
                $message = str_replace($var["Before"], $var["After"], $event->getMessage());
                $event->setMessage($message);
            }
        }
    }
}
