<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities;

use pocketmine\item\Item;
use pocketmine\item\Armor;
use muqsit\invmenu\InvMenu;
use pocketmine\block\Block;
use pocketmine\color\Color;
use pocketmine\nbt\tag\Tag;
use pocketmine\entity\Human;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\nbt\tag\ListTag;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use pocketmine\item\VanillaItems;
use onebone\economyapi\EconomyAPI;
use pocketmine\block\VanillaBlocks;
use pocketmine\inventory\Inventory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\block\BlockLegacyIds;
use pocketmine\scheduler\ClosureTask;
use pocketmine\scheduler\TaskHandler;
use BhawaniSingh\HCMinion\utils\Utils;
use BhawaniSingh\HCMinion\BetterMinion;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\StringToItemParser;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\event\entity\EntityDamageEvent;
use BhawaniSingh\HCMinion\minions\MinionUpgrade;
use pocketmine\world\particle\BlockBreakParticle;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use BhawaniSingh\HCMinion\minions\MinionInformation;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use BhawaniSingh\HCMinion\entities\inventory\MinionInventory;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;

abstract class MinionEntity extends Human
{
    public const ACTION_CANT_WORK = -1;
    public const ACTION_IDLE = 0;
    public const ACTION_TURNING = 1;
    public const ACTION_WORKING = 2;

    protected MinionInformation $minionInformation;
    protected MinionInventory $minionInventory;
    protected int $currentAction = self::ACTION_IDLE;
    protected int $currentActionTicks = 0;
    protected Block $target;
    private float $money = 0;

    protected Enchantment $fakeEnchant;

    /** @var float */
    protected $gravity = 0;

    public function saveNBT(): CompoundTag
    {
        $nbt = parent::saveNBT();

        if (isset($this->minionInventory)) {
            $nbt->setTag('MinionInventory', new ListTag(array_map(function (Item $item): CompoundTag {
                return $item->nbtSerialize();
            }, $this->minionInventory->getContents())));
        }
        if (isset($this->minionInformation)) {
            $nbt->setTag("MinionInformation", $this->minionInformation->nbtSerialize());
        }
        $nbt->setFloat('Money', $this->money);
        return $nbt;
    }

    public function attack(EntityDamageEvent $source): void
    {
        if ($source instanceof EntityDamageByEntityEvent) {
            $damager = $source->getDamager();
            if ($damager instanceof Player) {
                if (isset(BetterMinion::getInstance()->isRemove[$damager->getName()])) {
                    $damager->sendMessage('Successfully removed ' . $this->getMinionInformation()->getOwner() . "'s minion");
                    $this->destroy();
                    return;
                }
                if ($damager->getName() === $this->getMinionInformation()->getOwner()) {
                    $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);

                    $menu->setName("§r§l§eMINION INVENTORY");
                    $menu->getInventory()->setContents(array_fill(0, 53, ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));

                    // Auto Smelter
                    if ($this->canUseAutoSmelt()) {
                        $furnaceItem = VanillaBlocks::FURNACE()->asItem();
                        $menu->getInventory()->setItem(19, $furnaceItem->setCustomName('§r§l§eAuto Smelter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSmelt() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Smelts Items That\n§r§7The Minion Produces"]));
                    } else {
                        $menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::AUTO_SMELT_LEVEL . " to use the Auto Smelter!"));
                    }

                    // Auto Seller
                    if ($this->canUseAutoSell()) {
                        $hopper = VanillaBlocks::HOPPER()->asItem();
                        $menu->getInventory()->setItem(28, $hopper->setCustomName('§r§l§eAuto Seller §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSell() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Sell Automatically Resources When\n§r§7The Minion's Storage Is Full", "§r§l§dTotal Money: §f" . $this->money]));
                    } else {
                        $menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::AUTO_SELL_LEVEL . " to use the Auto Seller!"));
                    }

                    // Super Compacter
                    if ($this->canUseCompacter()) {
                        $dispenser = ItemFactory::getInstance()->get(23, 0, 1);
                        $menu->getInventory()->setItem(37, $dispenser->setCustomName('§r§l§eCompacter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isSuperCompacter() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Convert Items Into\n§r§7Block From This Upgrade"]));
                    } else {
                        $menu->getInventory()->setItem(37, ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_COMPACTER_LEVEL . " to use the Super Compacter!"));
                    }

                    // Super Expander
                    if ($this->canUseExpander()) {
                        $commandBlock = ItemFactory::getInstance()->get(137, 0, 1);
                        $commandBlock->addEnchantment(new EnchantmentInstance($this->fakeEnchant));

                        $menu->getInventory()->setItem(46, $commandBlock->setCustomName('§r§l§eExpander §l§7(' . ($this->getMinionInformation()->getUpgrade()->isSuperExpander() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Increases The Minion Range\n§r§7By One Block To High Blocks"]));
                    } else {
                        $menu->getInventory()->setItem(46, ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_EXPANDER_LEVEL . " to use the Super Expander!"));
                    }

                    $menu->getInventory()->setItem(48, ItemFactory::getInstance()->get(54, 0, 1)->setCustomName("§r§l§eCollect Items\n\n§r§7Click To Collect All Items From\n§r§7Your Minion Inventory To Your\n§r§7Inventory.\n\n§r§l§dClick To Collect"));
                    $menu->getInventory()->setItem(50, ItemFactory::getInstance()->get(ItemIds::NETHER_STAR)->setCustomName("§r§l§eUpgrade Minion\n\n§r§7Click To Upgrade Your Minion\n§r§7Level 1 To High Levels For\n§r§7Open Inventory Slots.\n\n§r§l§dClick To Upgrade")->setLore([$this->getMinionInformation()->getLevel() < 15 ? "§r§l§6Amount: " . TextFormat::GREEN . $this->getLevelUpCost() . "$" : TextFormat::LIGHT_PURPLE . "Reached Max Level"]));
                    $menu->getInventory()->setItem(52, ItemFactory::getInstance()->get(7, 0, 1)->setCustomName("§r§l§ePickup Minion\n\n§r§7Click To Pickup Your Minion\n§r§7To Move In New Location\n\n§r§l§dClick To Pickup"));
                    $menu->getInventory()->setItem(6, ItemFactory::getInstance()->get(ItemIds::GOLD_INGOT)->setCustomName("§r§e§lCOMMING SOON"));
                    $menu->getInventory()->setItem(5, ItemFactory::getInstance()->get(ItemIds::ENDER_EYE)->setCustomName("§r§l§eTOTAL UPGRADE AMOUNT\n§r§aLevel 1: §r§d0\n§r§aLevel 2: §r§d2000$\n§r§aLevel 3: §r§d4000$\n§r§aLevel 4: §r§d8000$\n§r§aLevel 5: §r§d10000$\n§r§aLevel 6: §r§d12500$\n§r§aLevel 7: §r§d15000$\n§r§aLevel 8: §r§d17500$\n§r§aLevel 9: §r§d20000$\n§r§aLevel 10: §r§d25000$\n§r§aLevel 11: §r§d30000$\n§r§aLevel 12: §r§d35000$\n§r§aLevel 13: §r§d40000$\n§r§aLevel 14: §r§d50000$\n§r§aLevel 15: §r§d100000$"));
                    BetterMinion::getInstance()->getScheduler()->scheduleRepeatingTask($task = new ClosureTask(function () use ($menu): void {
                        for ($i = 0; $i < 15; ++$i) {
                            $menu->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }
                        $types = ['Mining', 'Farming', 'Lumberjack', 'Slaying', 'Fishing'];
                        $menu->getInventory()->setItem(4, ItemFactory::getInstance()->get(ItemIds::SKULL, 3)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()))->setLore([
                            '§r§6Type: ' . TextFormat::WHITE . $types[$this->getMinionInformation()->getType()->getActionType()],
                            '§r§6Target: ' . TextFormat::WHITE . $this->getMinionInformation()->getType()->getTargetName(),
                            '§r§6Level: ' . TextFormat::WHITE . $this->getMinionInformation()->getLevel(),
                            '§r§6Resources Collected: ' . TextFormat::WHITE . $this->getMinionInformation()->getResourcesCollected(),
                        ]));
                    }), 20);
                    $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {
                        $player = $transaction->getPlayer();
                        $itemClicked = $transaction->getItemClicked();
                        $action = $transaction->getAction();

                        switch ($action->getSlot()) {
                            case 6:
                                break;
                            case 19:
                                // Auto Smelter
                                if ($this->canUseAutoSmelt()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isAutoSmelt()) {
                                        $this->getMinionInformation()->getUpgrade()->setAutoSmelt(true);
                                        $this->stopWorking();

                                        $player->sendMessage("§aAuto Smelter upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setAutoSmelt(false);
                                    $this->stopWorking();

                                    $player->sendMessage("§cAuto Smelter upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§cYou need to upgrade your minion to level " . MinionUpgrade::AUTO_SMELT_LEVEL . " to use the Auto Smelter!");
                                break;
                            case 28:
                                // Auto Sell
                                $player->removeCurrentWindow();
                                $player->sendMessage("§cAuto sell feature disabled temporarily.");
                                break;
                            case 37:
                                // Super Compacter
                                if ($this->canUseCompacter()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isSuperCompacter()) {
                                        $this->getMinionInformation()->getUpgrade()->setSuperCompacter(true);
                                        $this->stopWorking();

                                        $player->sendMessage("§aSuper Compacter upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setSuperCompacter(false);
                                    $this->stopWorking();

                                    $player->sendMessage("§cSuper Compacter upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_COMPACTER_LEVEL . " to use the Super Compacter!");
                                break;
                            case 46:
                                // Super Expander
                                if ($this->canUseExpander()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isSuperExpander()) {
                                        $this->getMinionInformation()->getUpgrade()->setSuperExpander(true);
                                        $this->stopWorking();

                                        $player->sendMessage("§aSuper Expander upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setSuperExpander(false);
                                    $this->stopWorking();

                                    $player->sendMessage("§cSuper Expander upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_EXPANDER_LEVEL . " to use the Super Expander!");
                                break;
                            case 48:
                                // Collect All
                                foreach ($this->getMinionInventory()->getContents() as $slot => $item) {
                                    if ($player->getInventory()->canAddItem($item)) {
                                        $player->getInventory()->addItem($item);
                                        $this->getMinionInventory()->setItem($slot, VanillaBlocks::AIR()->asItem());
                                        continue;
                                    }
                                    $player->sendMessage(TextFormat::RED . 'Your Inventory Is Full, Empty It Before Making A Transaction');
                                    break;
                                }
                                break;
                            case 50:
                                // Level Up
                                $player->removeCurrentWindow();
                                if ($this->getMinionInformation()->getLevel() < 15) {
                                    if (EconomyAPI::getInstance()->myMoney($player) - $this->getLevelUpCost() >= 0) {
                                        EconomyAPI::getInstance()->reduceMoney($player, $this->getLevelUpCost());
                                        $this->getMinionInformation()->incrementLevel();
                                        $player->sendMessage(TextFormat::GREEN . 'Your Minion Has Been Upgraded To Level ' . TextFormat::GOLD . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()));
                                        $this->getMinionInventory()->setSize($this->getMinionInformation()->getLevel());
                                        $this->stopWorking();
                                        break;
                                    }
                                    $player->sendMessage(TextFormat::RED . "You Don't Have Enough Money For Upgrade Minion");
                                    break;
                                }
                                $player->sendMessage(TextFormat::RED . 'Your Minion Has Reached The Maximum Level');
                                break;

                            case 52:
                                // Remove Minion
                                $player->removeCurrentWindow();
                                $this->destroy();
                                break;

                            default:
                                for ($i = 0; $i <= 15; ++$i) {
                                    if ($i > $this->getMinionInformation()->getLevel() - 1) {
                                        continue;
                                    }
                                    $slot = (int) (21 + ($i % 5) + (9 * floor($i / 5)));
                                    if ($action->getSlot() === $slot) {
                                        if ($player->getInventory()->canAddItem($itemClicked)) {
                                            $player->getInventory()->addItem($itemClicked);
                                            $remaining = $itemClicked->getCount();
                                            /** @var Item $item */
                                            foreach (array_reverse($this->getMinionInventory()->all($itemClicked), true) as $slot => $item) {
                                                $itemCount = $item->getCount();
                                                $this->getMinionInventory()->setItem($slot, $item->setCount(max($itemCount - $remaining, 0)));
                                                $remaining -= $itemCount;
                                                if ($remaining === 0) {
                                                    break;
                                                }
                                            }
                                        } else {
                                            $player->removeCurrentWindow();
                                            $player->sendMessage(TextFormat::RED . 'Your Inventory Is Full, Empty It Before Making A Transaction');
                                        }
                                    }
                                }
                                break;
                        }
                        for ($i = 0; $i < 15; ++$i) {
                            $action->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }
                    }));
                    $menu->send($damager);
                    $menu->setInventoryCloseListener(function (Player $player, Inventory $inventory) use ($task): void {
                        $taskHandler = $task->getHandler();
                        if ($taskHandler instanceof TaskHandler) {
                            $taskHandler->cancel();
                        }
                    });
                }
            }
        }
        $source->cancel();
    }

    public function entityBaseTick(int $tickDiff = 1): bool
    {
        $hasUpdate = parent::entityBaseTick($tickDiff);
        if (!$this->closed && !$this->isFlaggedForDespawn() && isset($this->minionInformation)) {
            if ($this->ticksLived % 60 === 0) {
                $this->updateTarget();
            }
            if (!$this->checkFull()) {
                return $hasUpdate;
            }
            if (!$this->target instanceof Block) {
                $this->getTarget();
            }
            ++$this->currentActionTicks;
            if ($this->target instanceof Block) {
                $this->target = $this->getWorld()->getBlock($this->target->getPosition());
                if (!$this->checkTarget()) {
                    $this->stopWorking();
                    return $hasUpdate;
                }
            }

            switch ($this->currentAction) {
                case self::ACTION_IDLE:
                    if ($this->currentActionTicks >= 60 && $this->target !== null) { //TODO: Customize
                        $this->currentAction = self::ACTION_TURNING;
                        $this->currentActionTicks = 0;
                    }
                    break;
                case self::ACTION_TURNING:
                    $this->lookAt($this->target->getPosition());
                    if ($this->currentActionTicks === 5) {
                        $this->currentAction = self::ACTION_WORKING;
                        $this->currentActionTicks = 0;
                    }
                    break;
                case self::ACTION_WORKING:
                    $isPlacing = $this->target->getId() === BlockLegacyIds::AIR;
                    if (!$isPlacing) {
                        if ($this->currentActionTicks === 1) {
                            $this->getWorld()->broadcastPacketToViewers($this->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_START_BREAK, (int) (65535 / 60), $this->target->getPosition()));
                        }
                        if ($this->isWorkFast() && $this->currentActionTicks === 2) {
                            $this->startWorking();
                            $this->stopWorking();
                        }
                        $pk = new AnimatePacket();
                        $pk->action = AnimatePacket::ACTION_SWING_ARM;
                        $pk->actorRuntimeId = $this->getId();
                        $this->getWorld()->broadcastPacketToViewers($this->getPosition(), $pk);
                    } else {
                        $this->getWorld()->broadcastPacketToViewers($this->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
                    }
                    if ($this->currentActionTicks === 60) {
                        $this->startWorking();
                        $this->stopWorking();
                        if (!$this->checkFull()) {
                            return $hasUpdate;
                        }
                    }
                    break;
                case self::ACTION_CANT_WORK:
                    if (!$this->isInventoryFull()) {
                        $this->currentAction = self::ACTION_IDLE;
                        $this->setNameTag($this->getMinionInformation()->getType()->getTargetName() . " Minion");
                    }
                    break;
            }
        }

        return $hasUpdate;
    }

    public function canBeCollidedWith(): bool
    {
        return false;
    }

    public function addEffect(EffectInstance $effect): bool
    {
        return false;
    }

    public function getMinionInformation(): MinionInformation
    {
        return $this->minionInformation;
    }

    public function getMinionInventory(): MinionInventory
    {
        return $this->minionInventory;
    }

    public function initEntity(CompoundTag $nbt): void
    {
        parent::initEntity($nbt);
        $this->setScale(0.550);
        $this->setImmobile();
        $this->setNameTagAlwaysVisible();

        $listTag = $nbt->getTag('MinionInformation');
        if (!$listTag instanceof ListTag) {
            return;
        }

        $this->minionInformation = MinionInformation::nbtDeserialize($listTag);
        $this->minionInventory = new MinionInventory(15);
        $this->minionInventory->setSize($this->minionInformation->getLevel());
        $this->money = $this->saveNBT()->getFloat('Money', 0);

        /** @phpstan-ignore-next-line */
        $this->fakeEnchant = new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BetterMinion::FAKE_ENCH_ID));
        $this->target = VanillaBlocks::AIR();

        $invTag = $this->saveNBT()->getTag('MinionInventory');
        if ($invTag instanceof ListTag) {
            $this->minionInventory->setContents(array_map(function (Tag $tag): Item {
                if ($tag instanceof CompoundTag) {
                    return Item::nbtDeserialize($tag);
                }
                return ItemFactory::getInstance()->get(BlockLegacyIds::STAINED_GLASS_PANE, 15);
            }, $invTag->getValue()));
        }
        $armor1 = ItemFactory::getInstance()->get(397, 3, 1);
        $color = new Color(192, 192, 192);
        $armor2 = ItemFactory::getInstance()->get(299, 0, 1);
        $armor2 instanceof Armor ? $armor2->setCustomColor($color) : null;
        $armor3 = ItemFactory::getInstance()->get(300, 0, 1);
        $armor3 instanceof Armor ? $armor3->setCustomColor($color) : null;
        $armor4 = ItemFactory::getInstance()->get(301, 0, 1);
        $armor4 instanceof Armor ? $armor4->setCustomColor($color) : null;
        $this->getArmorInventory()->setHelmet($armor1);
        $this->getArmorInventory()->setChestplate($armor2);
        $this->getArmorInventory()->setLeggings($armor3);
        $this->getArmorInventory()->setBoots($armor4);

        $tool = BetterMinion::getInstance()->getConfig()->getNested('tool.tier', 'diamond');
        $isNetheriteTool = $tool === 'Netherite';
        if (($item = $this->getTool($tool, $isNetheriteTool)) instanceof Item) {
            $this->getInventory()->setItemInHand($item);
        }

        if ($this->isInventoryFull()) {
            $this->stopWorking();
            $this->currentAction = self::ACTION_CANT_WORK;
        } else {
            $this->setNameTag($this->getMinionInformation()->getType()->getTargetName() . " Minion");
        }
    }

    protected function getSmeltedTarget(): ?Item
    {
        $contents = file_get_contents(BetterMinion::getInstance()->getDataFolder() . 'smelts.json');
        if (!is_string($contents)) {
            return null;
        }

        $smeltedItems = json_decode($contents, true);
        foreach ($smeltedItems as $input => $output) {
            $realInput = StringToItemParser::getInstance()->parse($input);
            $realOutput = StringToItemParser::getInstance()->parse($output);
            foreach ($this->getRealDrops() as $drop) {
                if ($realInput instanceof Item && $realOutput instanceof Item) {
                    if ($realInput->equals($drop, true)) {
                        return $realOutput;
                    }
                }
            }
        }
        return null;
    }

    /**
     * @return Item|null
     */
    protected function getCompactedTarget(): ?Item
    {
        $contents = file_get_contents(BetterMinion::getInstance()->getDataFolder() . 'compacts.json');
        if (!is_string($contents)) {
            return null;
        }

        $compactedItems = json_decode($contents, true);
        foreach ($compactedItems as $input => $output) {
            $realInput = StringToItemParser::getInstance()->parse($input);
            $realOutput = StringToItemParser::getInstance()->parse($output);
            foreach ($this->getRealDrops() as $drop) {
                if ($realInput instanceof Item && $realOutput instanceof Item) {
                    if ($realInput->equals($drop, true)) {
                        return $realOutput;
                    }
                }
            }
        }
        return null;
    }

    protected function getTargetDrops(): array
    {
        $drops = $this->getRealDrops();
        if ($this->getMinionInformation()->getUpgrade()->isAutoSmelt()) {
            $drops = [$this->getSmeltedTarget()];
        }
        if ($this->getMinionInformation()->getUpgrade()->isSuperCompacter()) {
            $drops = [$this->getCompactedTarget()];
        }

        return $drops;
    }

    protected function updateTarget(): void
    {
    }

    abstract protected function getTarget(): void;

    protected function checkTarget(): bool
    {
        return $this->target->getId() === BlockLegacyIds::AIR || ($this->target->getId() === $this->getMinionInformation()->getType()->getTargetId() && $this->target->getMeta() === $this->getMinionInformation()->getType()->getTargetMeta());
    }

    protected function startWorking(): void
    {
        $this->getWorld()->addParticle($this->target->getPosition()->add(0.5, 0.5, 0.5), new BlockBreakParticle($this->target));
        $this->getWorld()->setBlock($this->target->getPosition(), $this->target->getId() === BlockLegacyIds::AIR ? $this->getMinionInformation()->getType()->toBlock() : VanillaBlocks::AIR());
        if ($this->target->getId() !== BlockLegacyIds::AIR) {
            $drops = $this->getTargetDrops();
            foreach ($drops as $drop) {
                for ($i = 1; $i <= $drop->getCount(); ++$i) {
                    $thing = ItemFactory::getInstance()->get($drop->getId(), $drop->getMeta());
                    if ($this->getMinionInventory()->canAddItem($thing)) {
                        $this->getMinionInventory()->addItem($thing);
                        $this->getMinionInformation()->incrementResourcesCollected();
                    }
                }
            }
        }
    }

    protected function stopWorking(): void
    {
        $this->currentAction = self::ACTION_IDLE;
        $this->currentActionTicks = 0;
        if ($this->target instanceof Block) {
            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
            $this->target = VanillaBlocks::AIR();
        }
    }

    protected function isInventoryFull(): bool
    {
        $full = true;
        $drops = $this->getTargetDrops();

        foreach ($drops as $item) {
            if ($item instanceof Item) {
                if ($this->getMinionInventory()->canAddItem($item->setCount(1))) {
                    $full = false;
                    break;
                }
            }
        }
        return $full;
    }

    private function destroy(): void
    {
        if ($this->target instanceof Block) {
            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
        }
        foreach ($this->getMinionInventory()->getContents() as $content) {
            $this->getWorld()->dropItem($this->getPosition(), $content);
        }
        $minionItem = LegacyStringToItemParser::getInstance()->parse((string) BetterMinion::getInstance()->getConfig()->get('minion-item'));
        if (!$minionItem instanceof Item) {
            return;
        }

        $minionItem->setCustomName(TextFormat::RESET . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()));
        $minionItem->addEnchantment(new EnchantmentInstance($this->fakeEnchant));
        $minionItem->getNamedTag()->setTag("MinionInformation", $this->minionInformation->nbtSerialize());
        $this->getWorld()->dropItem($this->getPosition(), $minionItem);
        $this->flagForDespawn();
    }

    abstract protected function getTool(string $tool, bool $isNetheriteTool): ?Item;

    private function checkFull(): bool
    {
        if ($this->isInventoryFull()) {
            /*if ($this->getMinionInformation()->getUpgrade()->isAutoSell()) {
                $this->sellItems();
            }*/
            $this->currentAction = self::ACTION_CANT_WORK;
            return false;
        }
        return true;
    }

    private function getRealDrops(): array
    {
        $block = $this->getMinionInformation()->getType()->toBlock();
        $drops = $block->getDropsForCompatibleTool(VanillaItems::AIR());
        if (empty($drops)) {
            $drops = $block->getSilkTouchDrops(VanillaItems::AIR());
        }

        return $drops;
    }

    private function sellItems(): void
    {
        /*$sellAll = BetterMinion::getInstance()->getServer()->getPluginManager()->getPlugin('SellAll');
        if ($sellAll instanceof)

        $sellPrices = $sellAll->getConfig()->getAll();
        $item = $this->getMinionInventory()->getItem($this->getMinionInventory()->getSize() - 1);
        if (isset($sellPrices[$item->getId()])) {
            $this->money += $sellPrices[$item->getId()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        } elseif (isset($sellPrices[$item->getId() . ':' . $item->getMeta()])) {
            $this->money += $sellPrices[$item->getId() . ':' . $item->getMeta()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        }*/
    }

    private function getLevelUpCost(): int
    {
        $costs = (array) BetterMinion::getInstance()->getConfig()->get('levelup-costs');

        return (int) $costs[$this->getMinionInformation()->getLevel()];
    }

    protected function canUseAutoSmelt(): bool
    {
        return $this->getMinionInformation()->getLevel() >= MinionUpgrade::AUTO_SMELT_LEVEL;
    }

    protected function canUseAutoSell(): bool
    {
        return $this->getMinionInformation()->getLevel() >= MinionUpgrade::AUTO_SELL_LEVEL;
    }

    protected function canUseCompacter(): bool
    {
        return $this->getMinionInformation()->getLevel() >= MinionUpgrade::SUPER_COMPACTER_LEVEL;
    }

    protected function canUseExpander(): bool
    {
        return $this->getMinionInformation()->getLevel() >= MinionUpgrade::SUPER_EXPANDER_LEVEL;
    }

    protected function getMinionRange(): int
    {
        return $this->getMinionInformation()->getUpgrade()->isSuperExpander() ? 3 : 2;
    }

    protected function isWorkFast(): bool
    {
        return false;
    }
}
