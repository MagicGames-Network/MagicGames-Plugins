<?php

namespace AGTHARN\MagicWorldRegen;

use pocketmine\block\Block;
use pocketmine\world\World;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\promise\Promise;
use pocketmine\plugin\PluginBase;
use pocketmine\block\BlockFactory;
use pocketmine\world\format\Chunk;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\BlockLegacyIds;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\block\BlockBreakEvent;

class Main extends PluginBase implements Listener
{
	private array $blockStates = [];
	private int $blockIterator = 0;

	public function onEnable(): void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		$file = $this->getDataFolder() . "data.json";
		if (is_file($file)) {
			$contents = file_get_contents($file);
			if (!is_string($contents)) {
				return;
			}

			foreach (json_decode($contents, true) as $blockData) {
				$x = $blockData["x"];
				$y = $blockData["y"];
				$z = $blockData["z"];
				$world = $this->getServer()->getWorldManager()->getWorldByName($blockData["world"]);
				$id = $blockData["id"];
				$meta = $blockData["meta"];

				// this will force the server to wait for the results so that it doesn't crash when chunk is unloaded
				/** @phpstan-ignore-next-line */
				if ($world instanceof World && $world->requestChunkPopulation($x >> Chunk::COORD_BIT_SIZE, $z >> Chunk::COORD_BIT_SIZE, null) instanceof Promise) {
					$world->setBlock(new Position($x, $y, $z, $world), BlockFactory::getInstance()->get($id, $meta));
				}
			}
			@unlink($file);
		}
	}

	public function onDisable(): void
	{
		file_put_contents($this->getDataFolder() . "data.json", json_encode($this->blockStates));
	}

	public function delayedResetBlock(BlockBreakEvent $event, Block $replaceWith, ?Block $replaceTemp = null, int $replaceTicks = 100): bool
	{
		$player = $event->getPlayer();
		$block = $event->getBlock();
		
		$position = $block->getPosition();
		$world = $position->getWorld();

		$i = $this->blockIterator++;
		$this->blockStates[$i] = [
			"x" => $position->getX(),
			"y" => $position->getY(),
			"z" => $position->getZ(),
			"world" => $position->getWorld()->getFolderName(),
			"id" => $replaceWith->getId(),
			"meta" => $replaceWith->getMeta()
		];
		if (!$replaceTemp instanceof Block) {
			$replaceTemp = VanillaBlocks::AIR();
		}

		foreach ($event->getDrops() as $drop) {
			!$player->getInventory()->canAddItem($drop) ? $world->dropItem($position, $drop) : $player->getInventory()->addItem($drop);
			!$player->getXpManager()->canPickupXp() ? $world->dropExperience($position, $event->getXpDropAmount()) : $player->getXpManager()->addXp($event->getXpDropAmount());
		}

		$position->getWorld()->setBlock($position, $replaceTemp);
		$this->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($position, $replaceWith, $i): void {
			$position->getWorld()->setBlock($position, $replaceWith);
			if (isset($this->blockStates[$i])) {
				unset($this->blockStates[$i]);
			}
		}), $replaceTicks);

		return true;
	}

	/** 
	 * @handleCancelled
	 */
	public function onMiningBlockBreak(BlockBreakEvent $event): void
	{
		$whiteList = ["Mining"];
		if (in_array($event->getPlayer()->getWorld()->getFolderName(), $whiteList)) {
			$event->cancel();

			$block = $event->getBlock();
			$blockData = [$block->getId(), $block->getMeta()];
			match ($blockData) {
				[BlockLegacyIds::COAL_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::COAL_ORE()),
				[BlockLegacyIds::IRON_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::IRON_ORE()),
				[BlockLegacyIds::GOLD_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::GOLD_ORE()),
				[BlockLegacyIds::DIAMOND_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::DIAMOND_ORE()),
				[BlockLegacyIds::EMERALD_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::EMERALD_ORE()),
				[BlockLegacyIds::LAPIS_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::LAPIS_LAZULI_ORE()),
				[BlockLegacyIds::REDSTONE_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::REDSTONE_ORE()),
				[BlockLegacyIds::BROWN_MUSHROOM, 0] => $this->delayedResetBlock($event, VanillaBlocks::BROWN_MUSHROOM()),
				[BlockLegacyIds::RED_MUSHROOM, 0] => $this->delayedResetBlock($event, VanillaBlocks::RED_MUSHROOM()),
				[BlockLegacyIds::BROWN_MUSHROOM_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::BROWN_MUSHROOM_BLOCK()),
				[BlockLegacyIds::RED_MUSHROOM_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::RED_MUSHROOM_BLOCK()),
				[BlockLegacyIds::SUGARCANE_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::SUGARCANE()),
				[BlockLegacyIds::END_STONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::END_STONE()),
				[BlockLegacyIds::OBSIDIAN, 0] => $this->delayedResetBlock($event, VanillaBlocks::OBSIDIAN()),
				[BlockLegacyIds::DIRT, 0] => $this->delayedResetBlock($event, VanillaBlocks::DIRT()),
				[BlockLegacyIds::SAND, 0] => $this->delayedResetBlock($event, VanillaBlocks::SAND()),
				[BlockLegacyIds::NETHERRACK, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHERRACK()),
				[BlockLegacyIds::NETHER_QUARTZ_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHER_QUARTZ_ORE()),
				[BlockLegacyIds::STONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::STONE(), VanillaBlocks::BEDROCK()),
				[BlockLegacyIds::COBBLESTONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::COBBLESTONE(), VanillaBlocks::BEDROCK()),
				default => false
			};
		}
	}

	/** 
	 * @handleCancelled
	 */
	public function onMagicBlockBreak(BlockBreakEvent $event): void
	{
		$whiteList = ["MagicGames"];
		if (in_array($event->getPlayer()->getWorld()->getFolderName(), $whiteList)) {
			$event->cancel();

			$block = $event->getBlock();
			$blockData = [$block->getId(), $block->getMeta()];

			match ($blockData) {
				[BlockLegacyIds::WOOD, 0] => $this->delayedResetBlock($event, VanillaBlocks::OAK_WOOD()),
				[BlockLegacyIds::WOOD, 1] => $this->delayedResetBlock($event, VanillaBlocks::SPRUCE_WOOD()),
				[BlockLegacyIds::WOOD, 2] => $this->delayedResetBlock($event, VanillaBlocks::BIRCH_WOOD()),
				[BlockLegacyIds::WOOD, 3] => $this->delayedResetBlock($event, VanillaBlocks::JUNGLE_WOOD()),
				[BlockLegacyIds::WOOD, 4] => $this->delayedResetBlock($event, VanillaBlocks::ACACIA_WOOD()),
				[BlockLegacyIds::WOOD, 5] => $this->delayedResetBlock($event, VanillaBlocks::DARK_OAK_WOOD()),
				[BlockLegacyIds::NETHERRACK, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHERRACK()),
				[BlockLegacyIds::NETHER_QUARTZ_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHER_QUARTZ_ORE()),
				[BlockLegacyIds::OBSIDIAN, 0] => $this->delayedResetBlock($event, VanillaBlocks::OBSIDIAN()),
				default => false
			};

			$cropData = $block->getId();
			match ($cropData) {
				BlockLegacyIds::WHEAT_BLOCK => $this->delayedResetBlock($event, VanillaBlocks::WHEAT()->setAge(7), null, 1200),
				BlockLegacyIds::CARROT_BLOCK => $this->delayedResetBlock($event, VanillaBlocks::CARROTS()->setAge(7), null, 1200),
				BlockLegacyIds::POTATO_BLOCK => $this->delayedResetBlock($event, VanillaBlocks::POTATOES()->setAge(7), null, 1200),
				BlockLegacyIds::MELON_BLOCK => $this->delayedResetBlock($event, VanillaBlocks::MELON(), null, 1200),
				BlockLegacyIds::PUMPKIN => $this->delayedResetBlock($event, VanillaBlocks::PUMPKIN(), null, 1200),
				BlockLegacyIds::CACTUS => $this->delayedResetBlock($event, VanillaBlocks::CACTUS()->setAge(7), null, 1200),
				BlockLegacyIds::COCOA_BLOCK => $this->delayedResetBlock($event, VanillaBlocks::COCOA_POD()->setAge(7), null, 1200),
				BlockLegacyIds::NETHER_WART_PLANT => $this->delayedResetBlock($event, VanillaBlocks::NETHER_WART()->setAge(7), null, 1200),
				default => false
			};
		}
	}
}
