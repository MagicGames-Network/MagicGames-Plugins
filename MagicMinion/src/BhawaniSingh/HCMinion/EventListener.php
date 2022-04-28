<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion;

use pocketmine\item\Item;
use pocketmine\entity\Skin;
use pocketmine\event\Listener;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\ListTag;
use pocketmine\item\ItemFactory;
use BhawaniSingh\HCMinion\utils\Utils;
use pocketmine\event\player\PlayerJoinEvent;
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
			$mItem = ItemFactory::getInstance()->get(1098, 0, 1);
			if ($item->getId() === $mItem->getId() && $item->getMeta() === $mItem->getMeta() && $item->getNamedTag()->getTag('MinionInformation') instanceof ListTag) {
				if (!BetterMinion::getInstance()->getProvider()->hasMinionData($player->getName())) {
					BetterMinion::getInstance()->getProvider()->createMinionData($player->getName());
				}
				$minionData = BetterMinion::getInstance()->getProvider()->getMinionDataFromPlayer($player->getName());

				if (!$minionData["minionCount"] >= BetterMinion::MINION_LIMIT) {
					BetterMinion::getInstance()->getProvider()->updateMinionData($player->getName(), $minionData["minionCount"] + 1);
					$event->cancel();

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

					$skinData = Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "minion.png");
					//$geometryArray = Utils::createGeometryData(file_get_contents(BetterMinion::getInstance()->getDataFolder() . "minion.json"));

					$skin = new Skin($player->getSkin()->getSkinId(), $skinData/*, "", $geometryArray[0], $geometryArray[1]*/);

					/** @var MinionEntity $entity */
					$entity = new $entityType($entityPos, $skin, $nbt);
					$entity->spawnToAll();
					
					$item->pop();
					$player->getInventory()->setItemInHand($item);
					$player->sendMessage("§8(§b!§8) §7Minion placed! You have " . $minionData["minionCount"] . "/" . BetterMinion::MINION_LIMIT . "minions!");
					return;
				}
				$player->sendMessage("§8(§b!§8) §7You can't have more than 16 minions! You have " . $minionData["minionCount"] . "/" . BetterMinion::MINION_LIMIT . "minions!");
			}
		}
	}

	public function onPlayerQuit(PlayerQuitEvent $event): void
	{
		$player = $event->getPlayer();
		if (isset(BetterMinion::getInstance()->isRemove[$player->getName()])) {
			unset(BetterMinion::getInstance()->isRemove[$player->getName()]);
		}
	}
}
