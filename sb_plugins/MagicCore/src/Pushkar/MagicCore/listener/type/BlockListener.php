<?php

namespace Pushkar\MagicCore\listener\type;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;

class BlockListener implements Listener
{
    public function onPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getNamedTag()->getTag("enchantedblock") !== null) {
            $event->cancel();
            $player->sendMessage(" §eYou Can't Place Enchanted Blocks On Ground");
        }
    }
}
