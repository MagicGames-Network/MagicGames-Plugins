<?php

declare(strict_types=1);

namespace alvin0319\PlayerTrade\task;

use alvin0319\PlayerTrade\TradeQueue;
use pocketmine\scheduler\Task;

final class TradeQueueCheckTask extends Task{

	protected TradeQueue $queue;

	public function __construct(TradeQueue $queue){ $this->queue = $queue; }

	public function onRun() : void{
		if(!$this->queue->getReceiver()->isOnline()){
			$this->queue->cancel();
			return;
		}
		if(!$this->queue->getSender()->isOnline()){
			$this->queue->cancel(true, true);
		}
	}
}