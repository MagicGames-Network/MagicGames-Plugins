<?php
// thank you very much for helping JackNoordhuis

namespace fernanACM\GrapplingHook;

use pocketmine\block\Block;
use pocketmine\utils\Random;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\entity\Location;
use pocketmine\math\RayTraceResult;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\projectile\Throwable;
use pocketmine\entity\projectile\Projectile;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class FishingHook extends Throwable
{
	protected $gravity = 0.1;

	public static function getNetworkTypeId(): string
	{
		return EntityIds::FISHING_HOOK;
	}

	public function getResultDamage(): int
	{
		return 1;
	}

	protected function onHitBlock(Block $blockHit, RayTraceResult $hitResult): void
	{
		Projectile::onHitBlock($blockHit, $hitResult);
	}

	public function __construct(Location $pos, Entity $owner, ?CompoundTag $nbt = null)
	{
		parent::__construct($pos, $owner, $nbt);

		if ($owner instanceof Player) {
			$this->setPosition($this->location->add(0, $owner->getEyeHeight() - 0.1, 0));
			$this->setMotion($owner->getDirectionVector()->multiply(0.4));
			GrapplingHook::setFishingHook($this, $owner);
			$this->handleHookCasting($this->motion->x, $this->motion->y, $this->motion->z, 1.5, 1.0);
		}
	}

	public function handleHookCasting(float $x, float $y, float $z, float $f1, float $f2): void
	{
		$rand = new Random();
		$f = sqrt($x * $x + $y * $y + $z * $z);
		$x = $x / $f;
		$y = $y / $f;
		$z = $z / $f;
		$x = $x + $rand->nextSignedFloat() * 0.007499999832361937 * $f2;
		$y = $y + $rand->nextSignedFloat() * 0.007499999832361937 * $f2;
		$z = $z + $rand->nextSignedFloat() * 0.007499999832361937 * $f2;
		$x = $x * $f1;
		$y = $y * $f1;
		$z = $z * $f1;
		$this->motion->x += $x;
		$this->motion->y += $y;
		$this->motion->z += $z;
	}

	public function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void
	{
		//Do nothing
	}

	public function entityBaseTick(int $tickDiff = 1): bool
	{
		$hasUpdate = parent::entityBaseTick($tickDiff);
		$owner = $this->getOwningEntity();
		if ($owner instanceof Player) {
			if (!$owner->getInventory()->getItemInHand() instanceof FishingRod or !$owner->isAlive() or $owner->isClosed()) {
				$this->flagForDespawn();
			}
		} else {
			$this->flagForDespawn();
		}

		return $hasUpdate;
	}

	public function onDispose(): void
	{
		parent::onDispose();

		$owner = $this->getOwningEntity();
		if ($owner instanceof Player) {
			GrapplingHook::setFishingHook(null, $owner);
		}
	}

	public function handleHookRetraction(): void
	{
		$owner = $this->getOwningEntity();
		if ($owner instanceof Entity) {
			$ownerPos = $owner->getPosition();
			$dist = $this->location->distanceSquared($ownerPos);
			$owner->setMotion($this->location->subtractVector($ownerPos)->multiply($this->getGrapplingSpeed($dist)));
			$this->flagForDespawn();
		}
	}

	private function getGrapplingSpeed(float $dist): float
	{
		switch (true) {
			case $dist > 600:
				return 0.26;
			case $dist > 500:
				return 0.24;
			case $dist > 300:
				return 0.23;
			case $dist > 200:
				return 0.201;
			case $dist > 100:
				return 0.17;
			case $dist > 40:
				return 0.11;
			default:
				return 0.8;
		}
	}

	public function onUpdate(int $currentTick): bool
	{
		if ($this->closed) {
			return false;
		}

		if ($this->isUnderwater()) {
			$this->motion->y += $this->gravity;
		}

		return parent::onUpdate($currentTick);
	}
}
