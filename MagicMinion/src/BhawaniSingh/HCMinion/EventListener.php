<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\ListTag;
use BhawaniSingh\HCMinion\utils\Utils;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\LegacyStringToItemParser;
use BhawaniSingh\HCMinion\entities\MinionEntity;
use pocketmine\event\player\PlayerInteractEvent;
use BhawaniSingh\HCMinion\minions\MinionInformation;

class EventListener implements Listener
{
    /**
     * @ignoreCancelled
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        $item = $event->getItem();
        $block = $event->getBlock();
        $player = $event->getPlayer();
        if ($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK) {
            $mItem = LegacyStringToItemParser::getInstance()->parse((string) BetterMinion::getInstance()->getConfig()->get('minion-item'));

            if ($item->getId() === $mItem->getId() && $item->getMeta() === $mItem->getMeta()) {
                if ($item->getNamedTag()->getTag('MinionInformation') instanceof ListTag) {
                    $event->cancel();
                    /* if (!$block->isSolid()) {TODO: anti-glitch
                            $block = $block->getLevelNonNull()->getBlock($block->subtract(0, 1));
                        } */
                    $levelName = $player->getWorld()->getFolderName();
                    if (in_array($levelName, BetterMinion::getInstance()->getConfig()->get('worlds', []), true)) {
                        return;
                    }
                    $minionInformation = MinionInformation::nbtDeserialize($item->getNamedTag()->getTag('MinionInformation'));

                    $entityPos = $block->getSide($event->getFace())->getPosition();
                    $entityPos = new Location($entityPos->x + 0.5, $entityPos->y, $entityPos->z + 0.5, $player->getWorld(), 0, 0);
                    
                    $nbt = Utils::createBaseNBT($entityPos);

                    $level = $minionInformation->getLevel();
                    $resourcesCollect = $minionInformation->getResourcesCollected();
                    $nbt->setTag('MinionInformation', (new MinionInformation($player->getName(), $minionInformation->getType(), $minionInformation->getUpgrade(), $level, $resourcesCollect))->nbtSerialize());

                    $entityType = BetterMinion::$minions[$minionInformation->getType()->getActionType()];

                    /** @var MinionEntity $entity */
                    $entity = new $entityType($entityPos, $player->getSkin(), $nbt);

                    $entity->spawnToAll();
                    $item->pop();
                    $player->getInventory()->setItemInHand($item);
                }
            }
        }
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        if (isset(BetterMinion::getInstance()->isRemove[$player->getName()]))
            unset(BetterMinion::getInstance()->isRemove[$player->getName()]);
    }
}
