<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\commands\subcommands;

use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use BhawaniSingh\HCMinion\BetterMinion;
use pocketmine\item\StringToItemParser;
use BhawaniSingh\HCMinion\minions\MinionType;
use CortexPE\Commando\args\RawStringArgument;
use pocketmine\item\LegacyStringToItemParser;
use BhawaniSingh\HCMinion\minions\MinionUpgrade;
use BhawaniSingh\HCMinion\minions\MinionInformation;
use BhawaniSingh\HCMinion\commands\arguments\TypeArgument;

class GiveCommand extends BaseSubCommand
{
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if (!$sender->hasPermission('minion.commands')) {
            $sender->sendMessage("You don't have permission to use this command!");
            return;
        }
        $player = !isset($args['player']) ? null : Server::getInstance()->getPlayerByPrefix($args['player']);
        if (!$player instanceof Player) {
            $sender->sendMessage("That player can't be found");
            return;
        }
        if (!isset($args['type']) || !is_numeric($args['type'])) {
            $this->sendUsage();
            return;
        }
        $type = $args['type'];

        try {
            if (!isset($args['target'])) {
                $sender->sendMessage('Item not found!');
                return;
            }
            $target = StringToItemParser::getInstance()->parse($args['target']) ?? LegacyStringToItemParser::getInstance()->parse($args['target']);
            if ($target->getId() > 255) {
                $sender->sendMessage("That item can't be found");
                return;
            }
            $minionType = new MinionType((int) $type, $target->getId(), $target->getMeta());
            $minionUpgrade = new MinionUpgrade(false, false, false, false);
            $level = 1;
            $resourcesCollect = 0;

            $item = LegacyStringToItemParser::getInstance()->parse((string) BetterMinion::getInstance()->getConfig()->get('minion-item'));
            if (!$item instanceof Item) {
                $sender->sendMessage('Minion item is invalid!');
                return;
            }

            $item->setCustomName(TextFormat::RESET . TextFormat::YELLOW . $minionType->getTargetName() . ' Minion I');
            $item->getNamedTag()->setTag('MinionInformation', (new MinionInformation($player->getName(), $minionType, $minionUpgrade, $level, $resourcesCollect))->nbtSerialize());
            if (!$player->getInventory()->canAddItem($item)) {
                $sender->sendMessage('Player\'s inventory is full');
                return;
            }
            $player->getInventory()->addItem($item);
            $player->sendMessage('Successfully got you a minion');
        } catch (\InvalidArgumentException $exception) {
            $player->sendMessage("That item can't be found");
            return;
        }
    }

    protected function prepare(): void
    {
        $this->registerArgument(0, new RawStringArgument('player', true));
        $this->registerArgument(1, new TypeArgument('type', true));
        $this->registerArgument(2, new RawStringArgument('target', true));
    }
}
