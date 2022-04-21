<?php

namespace Peter\Dungeon;

use pocketmine\block\Grass;
use pocketmine\world\World;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\block\ItemFrame;
use pocketmine\item\FlintSteel;
use pocketmine\item\TieredTool;
use pocketmine\promise\Promise;
use pocketmine\item\ItemFactory;
use pocketmine\item\PaintingItem;
use pocketmine\plugin\PluginBase;
use pocketmine\block\BlockFactory;
use pocketmine\world\format\Chunk;
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
			foreach (json_decode(file_get_contents($file), true) as $blockData) {
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

	public function delayedResetBlock(Position $position, int $id, int $meta): void
	{
		$i = $this->blockIterator++;
		$this->blockStates[$i] = [
			"x" => $position->getX(),
			"y" => $position->getY(),
			"z" => $position->getZ(),
			"world" => $position->getWorld()->getFolderName(),
			"id" => $id,
			"meta" => $meta
		];
		$this->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($id, $meta, $position, $i): void {
			$position->getWorld()->setBlock($position, BlockFactory::getInstance()->get($id, $meta));
			if (isset($this->blockStates[$i])) {
				unset($this->blockStates[$i]);
			}
		}), 20 * 5);
	}

	public function onBlockBreak(BlockBreakEvent $event): void
	{
		$block = $event->getBlock();
		$player = $event->getPlayer();
		$world = $block->getPosition()->getWorld();
		$whiteList = $this->config->get("world");
		if (in_array($world->getFolderName(), $whiteList)) {
			foreach ($this->config->get("whitelist-block") as $data) {
				$data = explode(":", $data);
				if ($data[0] !== $block->getId() and $data[1] !== $block->getMeta()) {
					$event->cancel();
				}
			}
		}

		if (in_array($world->getFolderName(), $whiteList)) {
			if ($block->getId() === 16 && $block->getMeta() === 0 && $this->config->get("coal") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("coal") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 16, 0);
			} elseif ($block->getId() === 15 && $block->getMeta() === 0 && $this->config->get("iron") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("iron") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 15, 0);
			} elseif ($block->getId() === 14 && $block->getMeta() === 0 && $this->config->get("gold") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("gold") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 14, 0);
			} elseif ($block->getId() === 56 && $block->getMeta() === 0 && $this->config->get("diamond") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("diamond") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 56, 0);
			} elseif ($block->getId() === 129 && $block->getMeta() === 0 && $this->config->get("emerald") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("emerald") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 129, 0);
			} elseif ($block->getId() === 21 && $block->getMeta() === 0 && $this->config->get("lazuli") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("lazuli") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 21, 0);
			} elseif ($block->getId() === 73 && $block->getMeta() === 0 && $this->config->get("redstone") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("redstone") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 73, 0);
			} elseif ($block->getId() === 74 && $block->getMeta() === 0 && $this->config->get("redstone") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("redstone") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(4, 0));
				$this->delayedResetBlock($block->getPosition(), 74, 0);
				/*  / _| __ _ _ __ _ __ ___  ___ 
               | |_ / _` | '__| '_ ` _ \/ __|
               |  _| (_| | |  | | | | | \__ \
               |_|  \__,_|_|  |_| |_| |_|___/*/
			} elseif ($block->getId() === 59 && $block->getMeta() === 7 && $this->config->get("wheat") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("wheat") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 59, 7);
			} elseif ($block->getId() === 141 && $block->getMeta() === 7 && $this->config->get("diamond") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("carrot") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 141, 7);
			} elseif ($block->getId() === 142 && $block->getMeta() === 7 && $this->config->get("potato") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("potato") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 142, 7);
			} elseif ($block->getId() === 103 && $block->getMeta() === 0 && $this->config->get("melon") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("melon") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 103, 0);
			} elseif ($block->getId() === 86 && $block->getMeta() === 0 && $this->config->get("punpkin") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("punpkin") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 86, 0);
			} elseif ($block->getId() === 81 && $block->getMeta() === 0 && $this->config->get("cactus") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cactus") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 81, 0);
			} elseif ($block->getId() === 127 && $block->getMeta() === 8 && $this->config->get("cocoa") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cocoa") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 127, 8);
			} elseif ($block->getId() === 127 && $block->getMeta() === 9 && $this->config->get("cocoa") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cocoa") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 127, 9);
			} elseif ($block->getId() === 127 && $block->getMeta() === 10 && $this->config->get("cocoa") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cocoa") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 127, 10);
			} elseif ($block->getId() === 127 && $block->getMeta() === 11 && $this->config->get("cocoa") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cocoa") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 127, 11);
			} elseif ($block->getId() === 115 && $block->getMeta() === 3 && $this->config->get("fungus") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("fungus") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 115, 3);
			} elseif ($block->getId() === 39 && $block->getMeta() === 0 && $this->config->get("brown") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("brown") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 39, 0);
			} elseif ($block->getId() === 40 && $block->getMeta() === 0 && $this->config->get("red") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("red") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 40, 0);
			} elseif ($block->getId() === 99 && $block->getMeta() === 15 && $this->config->get("stem") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("stem") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 99, 15);
			} elseif ($block->getId() === 100 && $block->getMeta() === 15 && $this->config->get("stem") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("stem") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 100, 15);
			} elseif ($block->getId() === 99 && $block->getMeta() === 14 && $this->config->get("redblock") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("redblock") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 99, 14);
			} elseif ($block->getId() === 100 && $block->getMeta() === 14 && $this->config->get("brownblock") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("brownblock") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 100, 14);
			} elseif ($block->getId() === 83 && $block->getMeta() === 0 && $this->config->get("cane") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cane") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 83, 0);
				//WOODS
				//
				//
			} elseif ($block->getId() === 467 && $block->getMeta() === 0 && $this->config->get("oak") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("oak") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(17, 0, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 0);
			} elseif ($block->getId() === 467 && $block->getMeta() === 1 && $this->config->get("spruce") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("spruce") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(17, 1, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 1);
			} elseif ($block->getId() === 467 && $block->getMeta() === 2 && $this->config->get("birch") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("birch") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(17, 2, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 2);
			} elseif ($block->getId() === 467 && $block->getMeta() === 3 && $this->config->get("jungle") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("jungle") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(17, 3, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 3);
			} elseif ($block->getId() === 467 && $block->getMeta() === 4 && $this->config->get("acacia") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("acacia") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(162, 0, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 4);
			} elseif ($block->getId() === 467 && $block->getMeta() === 5 && $this->config->get("darkoak") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("darkoak") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem(ItemFactory::getInstance()->get(162, 1, 1)));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(0, 0));
				$this->delayedResetBlock($block->getPosition(), 467, 5);
				//
				//BLOCKS
				//
			} elseif ($block->getId() === 121 && $block->getMeta() === 0 && $this->config->get("end-stone") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("end-stone") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 121, 0);
			} elseif ($block->getId() === 49 && $block->getMeta() === 0 && $this->config->get("obsidian") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("obsidian") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 49, 0);
			} elseif ($block->getId() === 3 && $block->getMeta() === 0 && $this->config->get("dirt") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("dirt") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 3, 0);
			} elseif ($block->getId() === 12 && $block->getMeta() === 0 && $this->config->get("sand") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("sand") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 12, 0);
			} elseif ($block->getId() === 87 && $block->getMeta() === 0 && $this->config->get("netherrack") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("netherrack") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 87, 0);
			} elseif ($block->getId() === 1 && $block->getMeta() === 0 && $this->config->get("stone") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("stone") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 1, 0);
			} elseif ($block->getId() === 4 && $block->getMeta() === 0 && $this->config->get("cobblestone") === true) {
				foreach ($event->getDrops() as $drops) {
					if ($this->config->get("cobblestone") === true) {
						(!$player->getInventory()->canAddItem($drops)) ? ($world->dropItem($block->getPosition(), $drops)) : ($player->getInventory()->addItem($drops));
						(!$player->getXpManager()->canPickupXp()) ? ($world->dropExperience($block->getPosition(), $event->getXpDropAmount())) : ($player->getXpManager()->addXp($event->getXpDropAmount()));
						continue;
					}
					$world->dropItem($block->getPosition(), $drops);
					$world->dropExperience($block->getPosition(), $event->getXpDropAmount());
				}
				$event->cancel();
				$world->setBlock($block->getPosition(), BlockFactory::getInstance()->get(7, 0));
				$this->delayedResetBlock($block->getPosition(), 4, 0);
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
			if (!$player->hasPermission("admin.build")) {
				$event->cancel();
			}
		}
	}
	public function onPlayerBucketEmpty(PlayerBucketEmptyEvent $event): void
	{
		$player = $event->getPlayer();
		$whiteList = $this->config->get("world");
		if (in_array($player->getWorld()->getFolderName(), $whiteList)) {
			if (!$player->hasPermission("admin.build")) {
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
			if ($item instanceof PaintingItem or $item instanceof FlintSteel or $block instanceof ItemFrame or ($item instanceof TieredTool and $block instanceof Grass)) {
				if (!$player->hasPermission("admin.build")) {
					$event->cancel();
				}
			}
		}
	}
}
