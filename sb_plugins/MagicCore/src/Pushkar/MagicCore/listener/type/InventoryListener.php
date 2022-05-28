<?php

namespace Pushkar\MagicCore\listener\type;

use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryTransactionEvent;

class InventoryListener implements Listener
{
    public function onTransaction(InventoryTransactionEvent $event): void
    {
        $transaction = $event->getTransaction();
        foreach ($transaction->getActions() as $action) {
            $item = $action->getSourceItem();
            if ($item->getId() === 1070 && $item->getCustomName() === "§r§aSkyblock Menu §7( Right Click )§r") {
                $event->cancel();
            }
        }
    }
}
