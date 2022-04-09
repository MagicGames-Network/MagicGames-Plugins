<?php


namespace blueturk\skyblock\listener;

use blueturk\skyblock\SkyBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\world\biome\Biome;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\Server;

class IslandListener implements Listener
{


    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
            } elseif (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
            } elseif (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".interact") === true) {
                    $event->uncancel();
                } else {
                    $event->cancel();
                    $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you interact!");
                }
            } else {
                $event->cancel();
            }
        }
    }

    public function onPlaced(BlockPlaceEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $level = $player->getWorld()->getFolderName();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
            } elseif (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
            } elseif (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".place") === true) {

                        $event->uncancel();
                } else {
                    $event->cancel();
                    $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                }
            } else {
                $event->cancel();
            }
        }
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $level = $player->getWorld()->getFolderName();
        $block = $event->getBlock();
        $data = SkyBlock::getInstance()->getConfig();
        if ($data->getNested($level . ".island") != null) {
            if ($level === $player->getName()) {
                $event->uncancel();
            } elseif (Server::getInstance()->isOp($player->getName())) {
                $event->uncancel();
            } elseif (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                if ($data->getNested($level . ".island" . ".settings" . ".break") === true) {
                        $event->uncancel();

                } else {
                    $event->cancel();
                    $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                }
            } else {
                $event->cancel();
            }
        }
    }

    public function onPickingUp(EntityItemPickupEvent $event)
    {
        $viewers = $event->getInventory()->getViewers();
        foreach ($viewers as $player) {
            $level = $player->getWorld()->getFolderName();
            $data = SkyBlock::getInstance()->getConfig();
            if ($data->getNested($level . ".island") != null) {
                if ($level === $player->getName()) {
                    $event->uncancel();
                } elseif (Server::getInstance()->isOp($player->getName())) {
                    $event->uncancel();
                } elseif (in_array($player->getName(), $data->getNested($level . ".island" . ".this-partners"))) {
                    if ($data->getNested($level . ".island" . ".settings" . ".picking-up") === true) {
                        $event->uncancel();
                    } else {
                        $event->cancel();
                        $player->sendPopup(SkyBlock::BT_MARK . "cYour partner won't let you!");
                    }
                } else {
                    $event->cancel();
                }
            }
        }
    }

    public function onMove(PlayerMoveEvent $event)
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

    public function onDamage(EntityDamageEvent $event)
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
                if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
                    $event->cancel();
                }
                $event->cancel();
            } else {
                if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island") != null) {
                    $event->cancel();
                }
            }
        }
    }
}