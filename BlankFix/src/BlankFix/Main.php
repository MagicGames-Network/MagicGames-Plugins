<?php

namespace BlankFix;

use pocketmine\event\Listener;
use pocketmine\nbt\tag\ListTag;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;

class Main extends PluginBase implements Listener
{
    /** @var string[] */
    private array $toAlert = [];

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerLogin(PlayerLoginEvent $event): void
    {
        $player = $event->getPlayer();
        $rotation = $player->saveNBT()->getListTag("Rotation");
        if (!$rotation instanceof ListTag) {
            return;
        }

        $tags = $rotation->getValue();

        $yaw = $tags[0]->getValue();
        $pitch = $tags[1]->getValue();

        // NOTE: is_nan() will not work here
        if ($yaw == "NAN" || $pitch == "NAN") {
            $this->toAlert[$player->getUniqueId()->toString()] = [$yaw, $pitch];
            $player->setRotation(0.0, 0.0);
            $player->save();
        }
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        if (isset($this->toAlert[$player->getUniqueId()->toString()])) {
            $player->sendMessage($player->getName() . "! §cYou've run into a problem where you're stuck in one position! This should be corrected now, but if it hasn't, please rejoin the server. If this does not resolve the issue either, please contact an administrator on our Discord server.");
            unset($this->toAlert[$player->getUniqueId()->toString()]);
        }
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void
    {
        // if for whatever the player is still cached
        $player = $event->getPlayer();
        if (isset($this->toAlert[$player->getUniqueId()->toString()])) {
            unset($this->toAlert[$player->getUniqueId()->toString()]);
        }
    }
}
