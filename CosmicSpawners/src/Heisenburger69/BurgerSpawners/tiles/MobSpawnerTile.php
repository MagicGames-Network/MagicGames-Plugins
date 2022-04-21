<?php

namespace Heisenburger69\BurgerSpawners\tiles;

use pocketmine\item\Item;
use pocketmine\world\World;
use pocketmine\entity\Human;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\tile\Spawnable;
use Heisenburger69\BurgerSpawners\utils\Forms;
use Heisenburger69\BurgerSpawners\utils\Utils;
use Heisenburger69\BurgerSpawners\utils\ConfigManager;
use Heisenburger69\BurgerSpawners\entities\SpawnerEntity;

class MobSpawnerTile extends Spawnable
{
    public const ENTITY_ID = "EntityId"; //ID of the Entity
    public const TAG_ENTITY_IDENTIFIER = "EntityIdentifier";
    public const TAG_DISPLAY_ENTITY_SCALE = "DisplayEntityScale";
    public const LOAD_RANGE = "LoadRange"; //Distance for player beyond which no mobs are spawned
    public const SPAWN_RANGE = "SpawnRange"; //Radius around the spawner in which the mob might spawn
    public const BASE_DELAY = "BaseDelay"; //Delay in ticks between spawning of mobs
    public const DELAY = "Delay"; //Current Delay in ticks before the next mob is spawned
    public const COUNT = "Count"; //Number of spawners stacked
    
    private int $delay = 5;

    private CompoundTag $nbt;

    public function __construct(World $level, Vector3 $pos)
    {
        $this->nbt = $nbt = new CompoundTag();
        $range = (int)ConfigManager::getValue("spawn-range");
        if ($range === 0) { //Patch for outdated configs without "spawn-range" entry
            $range = 8;
        }
        if ($nbt->getTag(self::LOAD_RANGE) == null) {
            $nbt->setInt(self::LOAD_RANGE, $range);
        }
        if ($nbt->getTag(self::ENTITY_ID) == null) {
            $nbt->setString(self::ENTITY_ID, '');
        }

        if ($nbt->getTag(self::SPAWN_RANGE) == null) {
            $nbt->setInt(self::SPAWN_RANGE, 4);
        }
        $base = (int)ConfigManager::getValue("base-spawn-rate");
        $base = $base * 20;
        if ($nbt->getTag(self::BASE_DELAY) == null) {
            $nbt->setInt(self::BASE_DELAY, $base);
        }
        if ($nbt->getTag(self::DELAY) == null) {
            $nbt->setInt(self::DELAY, $base);
        }
        if ($nbt->getTag(self::COUNT) == null) {
            $nbt->setInt(self::COUNT, 1);
        }

        parent::__construct($level, $pos);
        if ($this->getEntityId() > 0) {
            $this->onUpdate();
        }
    }

    public function copyDataFromItem(Item $item): void
    {
        $nbt = $item->getNamedTag();
        if ($nbt->getTag(MobSpawnerTile::ENTITY_ID) !== null) {
            $entityId = $nbt->getTag(MobSpawnerTile::ENTITY_ID)->getValue();
            $this->setEntityId($entityId);
            $scale = ConfigManager::getValue("spawner-entity-scale");
            $this->setEntityScale($scale);
        }
        parent::copyDataFromItem($item);
    }

    public function onUpdate(): bool
    {
        $this->position->getWorld()->scheduleDelayedBlockUpdate($this->position, 20);

        if (!$this->canUpdate())
            return true;

        if ($this->delay <= 0) {
            $success = 0;
            for ($i = 0; $i < 16; $i++) {
                if ($success > 0) {
                    $this->delay = $this->getBaseDelay();
                    return true;
                }
                $pos = $this->getPosition()->add(mt_rand() / mt_getrandmax() * $this->getSpawnRange(), mt_rand(-1, 1), mt_rand() / mt_getrandmax() * $this->getSpawnRange());
                $target = $this->getPosition()->getWorld()->getBlock($pos);
                if ($target->getId() == BlockLegacyIds::AIR) {
                    $success++;
                    $entity = Utils::getEntityFromId($this->getEntityId(), new Location($pos->getX(), $pos->getY(), $pos->getZ(), $this->getPosition()->getWorld(), 0, 0));
                    if ($entity instanceof SpawnerEntity) {
                        $entity->spawnToAll();
                    }
                }
            }
            if ($success > 0) {
                $this->delay = $this->getBaseDelay();
            }
        } else {
            $this->delay = $this->delay - 1;
        }
        return true;
    }

    public function canUpdate(): bool
    {
        if (!$this->getPosition()->getWorld()->isChunkLoaded($this->getPosition()->getX() >> 4, $this->getPosition()->getZ() >> 4))
            return false;
        if ($this->getEntityId() == '')
            return false;
        if (!$this->getPosition()->getWorld()->getTile($this->getPosition()) instanceof self)
            return false;
        if ($this->getPosition()->getWorld()->getNearestEntity($this->getPosition(), 25, Human::class) instanceof Player)
            return true;
        return false;
    }

    public function getDelay(): int
    {
        return $this->getNBT()->getInt(self::DELAY);
    }

    public function setDelay(int $value): void
    {
        $this->getNBT()->setInt(self::DELAY, $value);
    }

    public function getBaseDelay(): int
    {
        $count = $this->getCount();
        $baseDelay = 5 / $count;
        $this->setBaseDelay($baseDelay);
        return $baseDelay;
    }

    public function setBaseDelay(int $value): void
    {
        $this->getNBT()->setInt(self::BASE_DELAY, $value);
    }

    public function getSpawnRange(): int
    {
        return $this->getNBT()->getInt(self::SPAWN_RANGE);
    }

    public function setSpawnRange(int $value): void
    {
        $this->getNBT()->setInt(self::SPAWN_RANGE, $value);
    }

    public function getCount(): int
    {
        return $this->getNBT()->getInt(self::COUNT);
    }

    public function setCount(int $value): void
    {
        $this->getNBT()->setInt(self::COUNT, $value);
    }

    public function getName(): string
    {
        return Utils::getEntityNameFromID($this->getEntityId()) . " Spawner";
    }

    public function getLoadRange(): int
    {
        return $this->getNBT()->getInt(self::LOAD_RANGE);
    }

    public function setLoadRange(int $range): void
    {
        $this->getNBT()->setInt(self::LOAD_RANGE, $range);
    }

    public function getEntityId(): string
    {
        return $this->getNBT()->getString(self::ENTITY_ID);
    }

    public function setEntityId(string $id): void
    {
        $this->getNBT()->setString(self::ENTITY_ID, $id);
        $this->position->getWorld()->scheduleDelayedBlockUpdate($this->position, 20);
    }

    public function setEntityScale(float $scale): void
    {
        $this->getNBT()->setFloat("DisplayEntityScale", $scale);
    }

    public function getNBT(): CompoundTag
    {
        return $this->nbt ?? $this->nbt = new CompoundTag();
    }

    public function addAdditionalSpawnData(CompoundTag $nbt): void
    {
        $this->baseData($nbt);
    }

    private function baseData(CompoundTag $nbt): void
    {
        $nbt->setString(self::ENTITY_ID, $this->getNBT()->getString(self::ENTITY_ID));
        $nbt->setString(self::TAG_ENTITY_IDENTIFIER, Utils::getEntityNameFromID($this->getEntityId()));
        $nbt->setFloat(self::TAG_DISPLAY_ENTITY_SCALE, 1.0);
        $nbt->setInt(self::DELAY, $this->getNBT()->getInt(self::DELAY));
        $nbt->setInt(self::LOAD_RANGE, $this->getNBT()->getInt(self::LOAD_RANGE));
        $nbt->setInt(self::SPAWN_RANGE, $this->getNBT()->getInt(self::SPAWN_RANGE));
        $nbt->setInt(self::COUNT, $this->getNBT()->getInt(self::COUNT));
    }

    public function readSaveData(CompoundTag $nbt): void
    {
        $this->nbt = $nbt;
    }

    protected function writeSaveData(CompoundTag $nbt): void
    {
        $this->baseData($nbt);
    }

    public function sendAddSpawnersForm(Player $player): void
    {
        Forms::sendAddSpawnerForm($player, $this);
    }

    public function sendRemoveSpawnersForm(Player $player): void
    {
        Forms::sendRemoveSpawnersForm($player, $this);
    }
}
