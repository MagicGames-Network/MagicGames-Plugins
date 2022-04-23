<?php

namespace CLADevs\VanillaX\entities\object;

use pocketmine\Server;
use pocketmine\world\World;
use pocketmine\entity\Entity;
use pocketmine\world\Position;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use CLADevs\VanillaX\session\Session;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class LightningBoltEntity extends Entity
{

    const NETWORK_ID = EntityIds::LIGHTNING_BOLT;

    public float $width = 1;
    public float $height = 1;

    private int $age = 5;

    public function canSaveWithChunk(): bool
    {
        return false;
    }

    public function entityBaseTick(int $tickDiff = 1): bool
    {
        $parent = parent::entityBaseTick($tickDiff);

        //TODO Disgusting code, ill patch it later.
        if ($this->age === 1) {
            if (in_array(Server::getInstance()->getDifficulty(), [World::DIFFICULTY_NORMAL, World::DIFFICULTY_HARD])) {
                for ($i = 1; $i <= 3; $i++) {
                    $block = $this->getPosition()->add(mt_rand(0, 2), mt_rand(0, 2), mt_rand(0, 2));
                    if ($this->getWorld()->getBlock($block)->getId() === BlockLegacyIds::AIR && $this->getWorld()->getBlock($block->subtract(0, 1, 0))->getId() !== BlockLegacyIds::AIR) {
                        $this->getWorld()->setBlock($block, BlockFactory::getInstance()->get(BlockLegacyIds::FIRE, 0));
                    }
                }
            }
            $this->sendImpactSound($this->getPosition());
            $this->sendRoarSound($this->getPosition());
        } else {
            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), LevelSoundEventPacket::nonActorSound(LevelSoundEvent::THUNDER, $this->getPosition(), false));
        }
        --$this->age;
        if ($this->age < 1) {
            $this->flagForDespawn();
        }
        return $parent;
    }

    protected function getInitialSizeInfo(): EntitySizeInfo
    {
        return new EntitySizeInfo($this->height, $this->width);
    }

    public static function getNetworkTypeId(): string
    {
        return self::NETWORK_ID;
    }

    public static function canRegister(): bool
    {
        return true;
    }

    public function sendImpactSound(Position $position, float $pitch = 1, float $volume = 1): void
    {
        $this->getWorld()->broadcastPacketToViewers($position, Session::playSound($position, "ambient.weather.lightning.impact", $pitch, $volume, true));
    }

    public function sendRoarSound(Position $position, float $pitch = 1, float $volume = 1): void
    {
        $this->getWorld()->broadcastPacketToViewers($position, Session::playSound($position, "ambient.weather.thunder", $pitch, $volume, true));
    }
}
