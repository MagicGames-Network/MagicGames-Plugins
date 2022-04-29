<?php

namespace AGTHARN\MagicWorldRegen;

use pocketmine\block\Block;
use pocketmine\block\Grass;
use pocketmine\world\World;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\block\ItemFrame;
use pocketmine\item\FlintSteel;
use pocketmine\item\TieredTool;
use pocketmine\promise\Promise;
use pocketmine\item\PaintingItem;
use pocketmine\plugin\PluginBase;
use pocketmine\block\BlockFactory;
use pocketmine\world\format\Chunk;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\BlockLegacyIds;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\event\block\{BlockPlaceEvent, BlockBreakEvent};

class Main extends PluginBase implements Listener
{
	private Config $config;

	private array $blockStates = [];
	private int $blockIterator = 0;

	public function onEnable(): void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

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

	public function onBlockBreak(BlockBreakEvent $event): void
	{
		$whiteList = $this->config->get("world");
		if (in_array($event->getPlayer()->getWorld()->getFolderName(), $whiteList)) {
			$block = $event->getBlock();

			$blockData = [$block->getId(), $block->getMeta()];
			$match = match ($blockData) {
				[BlockLegacyIds::COAL_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::COAL_ORE()),
				[BlockLegacyIds::IRON_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::IRON_ORE()),
				[BlockLegacyIds::GOLD_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::GOLD_ORE()),
				[BlockLegacyIds::DIAMOND_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::DIAMOND_ORE()),
				[BlockLegacyIds::EMERALD_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::EMERALD_ORE()),
				[BlockLegacyIds::LAPIS_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::LAPIS_LAZULI_ORE()),
				[BlockLegacyIds::REDSTONE_ORE, 0] => $this->delayedResetBlock($event, VanillaBlocks::REDSTONE_ORE()),
				[BlockLegacyIds::WHEAT_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::WHEAT()),
				[BlockLegacyIds::CARROT_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::CARROTS()),
				[BlockLegacyIds::POTATO_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::POTATOES()),
				[BlockLegacyIds::MELON_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::MELON()),
				[BlockLegacyIds::PUMPKIN, 0] => $this->delayedResetBlock($event, VanillaBlocks::PUMPKIN()),
				[BlockLegacyIds::CACTUS, 0] => $this->delayedResetBlock($event, VanillaBlocks::CACTUS()),
				[BlockLegacyIds::COCOA_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::COCOA_POD()),
				[BlockLegacyIds::NETHER_WART_PLANT, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHER_WART()),
				[BlockLegacyIds::BROWN_MUSHROOM, 0] => $this->delayedResetBlock($event, VanillaBlocks::BROWN_MUSHROOM()),
				[BlockLegacyIds::RED_MUSHROOM, 0] => $this->delayedResetBlock($event, VanillaBlocks::RED_MUSHROOM()),
				[BlockLegacyIds::BROWN_MUSHROOM_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::BROWN_MUSHROOM_BLOCK()),
				[BlockLegacyIds::RED_MUSHROOM_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::RED_MUSHROOM_BLOCK()),
				[BlockLegacyIds::SUGARCANE_BLOCK, 0] => $this->delayedResetBlock($event, VanillaBlocks::SUGARCANE()),
				[BlockLegacyIds::WOOD, 0] => $this->delayedResetBlock($event, VanillaBlocks::OAK_WOOD()),
				[BlockLegacyIds::WOOD, 1] => $this->delayedResetBlock($event, VanillaBlocks::SPRUCE_WOOD()),
				[BlockLegacyIds::WOOD, 2] => $this->delayedResetBlock($event, VanillaBlocks::BIRCH_WOOD()),
				[BlockLegacyIds::WOOD, 3] => $this->delayedResetBlock($event, VanillaBlocks::JUNGLE_WOOD()),
				[BlockLegacyIds::WOOD, 4] => $this->delayedResetBlock($event, VanillaBlocks::ACACIA_WOOD()),
				[BlockLegacyIds::WOOD, 5] => $this->delayedResetBlock($event, VanillaBlocks::DARK_OAK_WOOD()),
				[BlockLegacyIds::END_STONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::END_STONE()),
				[BlockLegacyIds::OBSIDIAN, 0] => $this->delayedResetBlock($event, VanillaBlocks::OBSIDIAN()),
				[BlockLegacyIds::DIRT, 0] => $this->delayedResetBlock($event, VanillaBlocks::DIRT()),
				[BlockLegacyIds::SAND, 0] => $this->delayedResetBlock($event, VanillaBlocks::SAND()),
				[BlockLegacyIds::NETHERRACK, 0] => $this->delayedResetBlock($event, VanillaBlocks::NETHERRACK()),
				[BlockLegacyIds::STONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::STONE()),
				[BlockLegacyIds::COBBLESTONE, 0] => $this->delayedResetBlock($event, VanillaBlocks::COBBLESTONE()),
				default => false
			};

			if ($match) {
				$event->cancel();
			}
		}
	}

	public function onBlockPlace(BlockPlaceEvent $event): void
	{
		$block = $event->getBlock();
		$player = $event->getPlayer();
		$world = $block->getPosition()->getWorld();

		$whiteList = $this->config->get("world");
		if (in_array($world->getFolderName(), $whiteList)) {
			if (!$player->hasPermission("mwr.admin.bypass")) {
				$event->cancel();
			}
		}
	}

	public function onPlayerBucketEmpty(PlayerBucketEmptyEvent $event): void
	{
		$player = $event->getPlayer();

		$whiteList = $this->config->get("world");
		if (in_array($player->getWorld()->getFolderName(), $whiteList)) {
			if (!$player->hasPermission("mwr.admin.bypass")) {
				$event->cancel();
			}
		}
	}

	public function onPlayerInteract(PlayerInteractEvent $event): void
	{
		$player = $event->getPlayer();
		$item = $event->getItem();
		$block = $event->getBlock();
		$world = $player->getWorld()->getFolderName();

		$whiteList = $this->config->get("world");
		if (in_array($world, $whiteList)) {
			if ($item instanceof PaintingItem || $item instanceof FlintSteel || $block instanceof ItemFrame || ($item instanceof TieredTool && $block instanceof Grass)) {
				if (!$player->hasPermission("mwr.admin.bypass")) {
					$event->cancel();
				}
			}
		}
	}
}
