<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\exoblock;

use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\player\Player;
use muqsit\dimensionportals\world\WorldManager;
use muqsit\dimensionportals\world\WorldInstance;

class EndPortalExoBlock extends PortalExoBlock
{

	public function getTargetWorldInstance(): WorldInstance
	{
		return WorldManager::getEnd();
	}

	public function interact(Block $wrapping, Player $player, Item $item, int $face): bool
	{
		return false;
	}

	public function update(Block $wrapping): bool
	{
		return false;
	}
}
