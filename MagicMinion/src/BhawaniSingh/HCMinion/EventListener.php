<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion;

use pocketmine\entity\Skin;
use pocketmine\event\Listener;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\ListTag;
use pocketmine\block\BlockLegacyIds;
use BhawaniSingh\HCMinion\utils\Utils;
use pocketmine\event\player\PlayerQuitEvent;
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
			if ($item->getNamedTag()->getTag('MinionInformation') instanceof ListTag) {
				if (!BetterMinion::getInstance()->getProvider()->hasMinionData($player->getName())) {
					BetterMinion::getInstance()->getProvider()->createMinionData($player->getName());
				}
				$minionData = BetterMinion::getInstance()->getProvider()->getMinionDataFromPlayer($player->getName());

				$worldName = $player->getWorld()->getFolderName();
				if (!$player->hasPermission("place.minion")) {
					if ($worldName !== $player->getName()) {
						$player->sendMessage(" §eYou Can Only Place Minion On Your Island");
						return;
					}
				}

				if ($minionData["minionCount"] < BetterMinion::MINION_LIMIT) {
					if (!$player->hasPermission("place.minion")) {
						BetterMinion::getInstance()->getProvider()->updateMinionData($player->getName(), $minionData["minionCount"] + 1);
					}
					$event->cancel();

					$minionInformation = MinionInformation::nbtDeserialize($item->getNamedTag()->getTag('MinionInformation'));
					$entityPos = $block->getSide($event->getFace())->getPosition();
					$entityPos = new Location($entityPos->x + 0.5, $entityPos->y, $entityPos->z + 0.5, $player->getWorld(), 0, 0);

					$nbt = Utils::createBaseNBT($entityPos);

					$level = $minionInformation->getLevel();
					$resourcesCollect = $minionInformation->getResourcesCollected();
					$nbt->setTag('MinionInformation', (new MinionInformation($player->getName(), $minionInformation->getType(), $minionInformation->getUpgrade(), $level, $resourcesCollect))->nbtSerialize());

					$entityType = BetterMinion::$minions[$minionInformation->getType()->getActionType()];

					$skinDataData = [$minionInformation->getType()->getTargetId(), $minionInformation->getType()->getTargetMeta()];
					$skinData = match ($skinDataData) {
						[BlockLegacyIds::COBBLESTONE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "pl.png"),
						[BlockLegacyIds::LOG, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "oak.png"),
						[BlockLegacyIds::LOG, 1] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "spruce.png"),
						[BlockLegacyIds::LOG, 2] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "birch.png"),
						[BlockLegacyIds::LOG, 3] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "jungle.png"),
						[BlockLegacyIds::LOG2, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "acacia.png"),
						[BlockLegacyIds::LOG2, 1] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "dark_oak.png"),
						[BlockLegacyIds::CARROT_BLOCK, 7] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "carrot.png"),
						[BlockLegacyIds::POTATO_BLOCK, 7] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "potato.png"),
						[BlockLegacyIds::WHEAT_BLOCK, 7] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "wheat.png"),
						[BlockLegacyIds::MELON_BLOCK, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "melon.png"),
						[BlockLegacyIds::PUMPKIN, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "pumpkin.png"),
						[BlockLegacyIds::CLAY_BLOCK, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "clay.png"),
						[BlockLegacyIds::EMERALD_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "emerald.png"),
						[BlockLegacyIds::DIAMOND_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "diamond.png"),
						[BlockLegacyIds::NETHER_QUARTZ_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "quartz.png"),
						[BlockLegacyIds::GOLD_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "gold.png"),
						[BlockLegacyIds::IRON_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "iron.png"),
						[BlockLegacyIds::COAL_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "coal.png"),
						[BlockLegacyIds::LAPIS_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "lapis.png"),
						[BlockLegacyIds::REDSTONE_ORE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "redstone.png"),
						[BlockLegacyIds::END_STONE, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "endstone.png"),
						[BlockLegacyIds::NETHERRACK, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "netherrack.png"),
						[BlockLegacyIds::SNOW_BLOCK, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "snow.png"),
						[BlockLegacyIds::SAND, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "sand.png"),
						[BlockLegacyIds::OBSIDIAN, 0] => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "obsidian.png"),
						default => Utils::createSkin(BetterMinion::getInstance()->getDataFolder() . "minion.png")
					};

					$skin = new Skin($player->getSkin()->getSkinId(), $skinData);

					/** @var MinionEntity $entity */
					$entity = new $entityType($entityPos, $skin, $nbt);
					$entity->spawnToAll();

					$item->pop();
					$player->getInventory()->setItemInHand($item);
					$player->sendMessage(" §eMinion placed! You have §6" . ($minionData["minionCount"] + 1) . "/" . BetterMinion::MINION_LIMIT . " §eminions!");
					return;
				}
				$player->sendMessage(" §eYou can't have more than 16 minions! You have §6" . $minionData["minionCount"]  . "/" . BetterMinion::MINION_LIMIT . " §eminions!");
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
