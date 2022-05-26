<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\event\player;

use pocketmine\block\Block;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use muqsit\dimensionportals\event\DimensionPortalsEvent;

class PlayerCreatePortalEvent extends DimensionPortalsEvent implements Cancellable
{
	use CancellableTrait;

	public function __construct(
		private Player $player,
		private Position $block_pos
	) {
	}

	final public function getPlayer(): Player
	{
		return $this->player;
	}

	final public function getBlockPos(): Position
	{
		return $this->block_pos;
	}
}
