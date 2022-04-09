<?php


namespace blueturk\skyblock\listener;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use blueturk\skyblock\SkyBlock;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityItemPickupEvent;

class IslandListener implements Listener
{
    public function onInteract(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
                return;
            }
            if (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
                return;
            }
            if (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".interact") === true) {
                    $event->uncancel();
                    return;
                }
                $event->cancel();
                $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you interact!");
                return;
            }
            $event->cancel();
        }
    }

    public function onPlaced(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
                return;
            }
            if (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
                return;
            }
            if (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".place") === true) {
                    $event->uncancel();
                    return;
                }
                $event->cancel();
                $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                return;
            }
            $event->cancel();
        }
    }

    public function onBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
                return;
            }
            if (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
                return;
            }
            if (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".break") === true) {
                    $event->uncancel();
                    return;
                }
                $event->cancel();
                $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                return;
            }
            $event->cancel();
        }
    }

    public function onPickingUp(EntityItemPickupEvent $event): void
    {
        $viewers = $event->getInventory()->getViewers();
        foreach ($viewers as $player) {
            $level = $player->getWorld()->getFolderName();
            $data = SkyBlock::getInstance()->getConfig();
            if ($data->getNested($level . ".island") != null) {
                if ($level === $player->getName()) {
                    $event->uncancel();
                    return;
                }
                if (Server::getInstance()->isOp($player->getName())) {
                    $event->uncancel();
                    return;
                }
                if (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                    if ($data->getNested($level . ".island" . ".settings" . ".picking-up") === true) {
                        $event->uncancel();
                        return;
                    }
                    $event->cancel();
                    $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                    return;
                }
                $event->cancel();
            }
        }
    }

    public function onMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if (in_array($player->getName(), $data->getNested($level . ".island" . ".banneds"))) {
                if (!Server::getInstance()->isOp($player->getName())) {
                    $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSpawnLocation());
                    $player->sendPopup(SkyBlock::BT_MARK . "cYou are banned on this island!");
                }
            }
        }
    }

    public function onDamage(EntityDamageEvent $event): void
    {
        $player = $event->getEntity();
        if ($player instanceof Player) {
            $level = $player->getWorld()->getFolderName();
            if ($level === $player->getName()) {
                if ($event->getCause() === EntityDamageEvent::CAUSE_VOID) {
                    $event->cancel();
                    $player->teleport(Server::getInstance()->getWorldManager()->getWorldByName($player->getName())->getSpawnLocation());
                    if ($player->getXpManager()->getXpLevel() >= 7) {
                        $player->getXpManager()->setXpLevel($player->getXpManager()->getXpLevel() - 7);
                        $player->sendMessage("§8» §cUnfortunately, you died in adana and lost §7(%3) XP §c experience level.");
                    }
                }
                /*if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
                    $event->cancel();
                }*/
                $event->cancel();
                return;
            }
            if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island") != null) {
                $event->cancel();
            }
        }
    }
}
