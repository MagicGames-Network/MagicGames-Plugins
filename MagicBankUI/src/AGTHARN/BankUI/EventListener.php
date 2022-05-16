<?php

namespace AGTHARN\BankUI;

use AGTHARN\BankUI\bank\Banks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $playerSession = Main::getInstance()->getSessionManager()->getSession($event->getPlayer());
        if (!$playerSession->allowed && $playerSession->money >= Banks::MONEY_LIMIT) {
            $playerSession->handleMessage(" §cWe have detected your bank with a large sum of money and, have flagged and frozen your account!");
            $playerSession->frozen = true;
        }
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void
    {
        Main::getInstance()->getSessionManager()->getSession($event->getPlayer())->remove();
    }
}
