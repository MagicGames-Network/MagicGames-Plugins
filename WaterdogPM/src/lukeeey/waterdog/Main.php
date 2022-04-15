<?php

declare(strict_types=1);

namespace lukeeey\waterdog;

use ReflectionClass;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\raklib\RakLibInterface;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $network = $this->getServer()->getNetwork();
        foreach ($network->getInterfaces() as $interface) {
            if ($interface instanceof RakLibInterface) {
                $interface->setPacketLimit(PHP_INT_MAX);
                $interface->shutdown();

                $network->unregisterInterface($interface);
                $network->registerInterface(new ModifiedRakLibInterface($this->getServer(), $this->getServer()->getIp(), $this->getServer()->getPort(), false));
                return;
            }
        }
    }

    public function onPacketReceive(DataPacketReceiveEvent $event): void
    {
        $packet = $event->getPacket();
        $player = $event->getOrigin()->getPlayer();
        if ($packet instanceof LoginPacket && $player instanceof Player) {
            if (!isset($packet->clientData["Waterdog_IP"])) {
                $player->kick("§cSneaky stuff right there. Join from the main server.");
                return;
            }
            $class = new ReflectionClass($event->getOrigin()->getPlayer());

            $prop = $class->getProperty("ip");
            $prop->setAccessible(true);
            $prop->setValue($player, $packet->clientData["Waterdog_IP"]);
        }
    }
}
