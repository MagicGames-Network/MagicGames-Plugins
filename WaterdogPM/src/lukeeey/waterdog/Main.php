<?php

declare(strict_types=1);

namespace lukeeey\waterdog;

use PrefixedLogger;
use ReflectionClass;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\raklib\RakLibInterface;
use pocketmine\event\server\NetworkInterfaceRegisterEvent;
use pocketmine\network\query\DedicatedQueryNetworkInterface;

class Main extends PluginBase implements Listener
{
    private bool $modified = false;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onInterfaceRegister(NetworkInterfaceRegisterEvent $event): void
    {
        $interface = $event->getInterface();
        if ($this->modified && $interface instanceof DedicatedQueryNetworkInterface) {
            $event->cancel();
            return;
        }
        if (!$this->modified && $interface instanceof RakLibInterface && !$interface instanceof ModifiedRakLibInterface) {
            $event->cancel();

            $this->getServer()->getNetwork()->registerInterface(new ModifiedRakLibInterface($this->getServer(), $this->getServer()->getIp(), $this->getServer()->getPort(), false));
            //$this->getServer()->getNetwork()->registerInterface(new DedicatedQueryNetworkInterface($this->getServer()->getIp(), $this->getServer()->getPort(), false, new PrefixedLogger($this->getServer()->getLogger(), "Dedicated Query Interface")));
            
            $this->modified = true;
        }
    }

    public function onPacketReceive(DataPacketReceiveEvent $event): void
    {
        $packet = $event->getPacket();
        $player = $event->getOrigin()->getPlayer();
        if ($packet instanceof LoginPacket && $player instanceof Player) {
            if (!isset($packet->clientData["Waterdog_IP"]) || !isset($packet->clientData["Waterdog_XUID"])) {
                $player->kick("§cSneaky stuff right there. Join from the main server.");
                return;
            }
            $class = new ReflectionClass($event->getOrigin()->getPlayer());

            $ipProp = $class->getProperty("ip");
            $ipProp->setAccessible(true);
            $ipProp->setValue($player, $packet->clientData["Waterdog_IP"]);
        }
    }
}
