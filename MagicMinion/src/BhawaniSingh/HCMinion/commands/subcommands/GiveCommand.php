<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\commands\subcommands;

use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use BhawaniSingh\HCMinion\BetterMinion;
use pocketmine\item\StringToItemParser;
use BhawaniSingh\HCMinion\minions\MinionType;
use CortexPE\Commando\args\RawStringArgument;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\LegacyStringToItemParser;
use BhawaniSingh\HCMinion\minions\MinionUpgrade;
use BhawaniSingh\HCMinion\minions\MinionInformation;
use pocketmine\item\enchantment\EnchantmentInstance;
use BhawaniSingh\HCMinion\commands\arguments\TypeArgument;

class GiveCommand extends BaseSubCommand
{
    private EnchantmentInstance $fakeEnchant;

    public function __construct(string $name, string $description = "", array $aliases = [])
    {
        parent::__construct($name, $description, $aliases);

        /** @phpstan-ignore-next-line */
        $this->fakeEnchant = new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BetterMinion::FAKE_ENCH_ID));
    }
    
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

            $item = ItemFactory::getInstance()->get(1098, 0, 1);
            $item->addEnchantment($this->fakeEnchant);
            $item->setCustomName(TextFormat::RESET . TextFormat::YELLOW . $minionType->getTargetName() . ' Minion I')->setLore(["§r§7Place this minion and it will\n§r§7start generating and mining blocks!\n§r§7Requires an open area to spawn\n§r§7blocks. Minions also work when you are offline!\n\n§r§eType: §b" . $minionType->getTargetName() . "\n§r§eLevel: §bI\n§r§eResources Collected: §b0"]);
            $item->getNamedTag()->setTag('MinionInformation', (new MinionInformation($player->getName(), $minionType, $minionUpgrade, $level, $resourcesCollect))->nbtSerialize());
            if (!$player->getInventory()->canAddItem($item)) {
                $sender->sendMessage('Player\'s inventory is full');
                return;
            }
            $player->getInventory()->addItem($item);
            $player->sendMessage("§8(§b!§8) §7Successfully Got You A §e" . $minionType->getTargetName() . "§7 Minion");
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
