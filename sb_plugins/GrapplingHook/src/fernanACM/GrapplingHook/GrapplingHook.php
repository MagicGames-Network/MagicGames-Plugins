<?php
// thank you very much for helping JackNoordhuis

namespace fernanACM\GrapplingHook;

use pocketmine\world\World;
use pocketmine\item\ItemIds;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\item\ItemIdentifier;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntityFactory;
use pocketmine\entity\EntityDataHelper;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\event\entity\EntityDamageEvent;

class GrapplingHook extends PluginBase implements Listener
{
	private static array $fishing = [];

	public static function getFishingHook(Player $player): ?FishingHook
	{
		return self::$fishing[$player->getName()] ?? null;
	}

	public static function setFishingHook(?FishingHook $fish, Player $player): void
	{
		self::$fishing[$player->getName()] = $fish;
	}

	public function onEnable(): void
	{
		ItemFactory::getInstance()->register(new FishingRod(new ItemIdentifier(ItemIds::FISHING_ROD, 0)), true);

		EntityFactory::getInstance()->register(FishingHook::class, function (World $world, CompoundTag $nbt): Entity {
			return new FishingHook(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
		}, ['FishingHook', 'minecraft:fishinghook'], EntityLegacyIds::FISHING_HOOK);

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDamage(EntityDamageEvent $event): void
	{
		$player = $event->getEntity();
		if (!$player instanceof Player || $event->getCause() !== EntityDamageEvent::CAUSE_FALL) {
			return;
		}

		if ($player->getInventory()->getItemInHand()->getId() === ItemIds::FISHING_ROD and $player->hasPermission("grapplinghook.acm")) {
			$event->cancel();
		}
	}
}
