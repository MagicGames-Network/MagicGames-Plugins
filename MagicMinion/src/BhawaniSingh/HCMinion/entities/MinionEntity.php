<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities;

use pocketmine\Server;
use pocketmine\nbt\NBT;
use pocketmine\block\Air;
use pocketmine\item\Item;
use pocketmine\item\Armor;
use muqsit\invmenu\InvMenu;
use pocketmine\block\Block;
use pocketmine\color\Color;
use pocketmine\world\World;
use pocketmine\entity\Human;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use AndreasHGK\SellAll\SellAll;
use pocketmine\nbt\tag\ListTag;
use pocketmine\timings\Timings;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use pocketmine\item\VanillaItems;
use onebone\economyapi\EconomyAPI;
use pocketmine\world\format\Chunk;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\inventory\Inventory;
use pocketmine\nbt\tag\CompoundTag;
use BhawaniSingh\HCMinion\utils\Utils;
use BhawaniSingh\HCMinion\BetterMinion;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\StringToItemParser;
use pocketmine\entity\effect\EffectInstance;
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
    protected int $currentActionSeconds = 0;

    protected bool $isViewingInv = false;
    protected bool $isWorking = false;

    protected Block $target;

    private float $money = 0;

    protected EnchantmentInstance $fakeEnchant;

    /** @var float */
    protected $gravity = 0;

    public function saveNBT(): CompoundTag
    {
        $nbt = parent::saveNBT();

        if (isset($this->minionInformation)) {
            $nbt->setTag("MinionInformation", $this->minionInformation->nbtSerialize());
        }
        if (isset($this->minionInventory)) {
            $nbt->setTag('MinionInventory', new ListTag(
                array_map(
                    fn (Item $item) => $item->nbtSerialize(),
                    $this->minionInventory->getContents()
                ),
                NBT::TAG_Compound
            ));
        }
        if (isset($this->money)) {
            $nbt->setFloat('Money', $this->money);
        }

        return $nbt;
    }

    public function attack(EntityDamageEvent $source): void
    {
        if ($source instanceof EntityDamageByEntityEvent) {
            $damager = $source->getDamager();
            if ($damager instanceof Player) {
                if (isset(BetterMinion::getInstance()->isRemove[$damager->getName()])) {
                    $damager->sendMessage('§8(§b!§8) §7Successfully removed ' . $this->getMinionInformation()->getOwner() . "'s minion");
                    $this->destroy();
                    return;
                }
                if ($damager->getName() === $this->getMinionInformation()->getOwner() || Server::getInstance()->isOp($damager->getName())) {
                    $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
                    $menu->setName("§r§l§eMINION INVENTORY");

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

                                        $player->sendMessage("§8(§b!§8) §7Auto Smelter upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setAutoSmelt(false);

                                    $player->sendMessage("§8(§b!§8) §7Auto Smelter upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§8(§b!§8) §7You need to upgrade your minion to level §e" . MinionUpgrade::AUTO_SMELT_LEVEL . "§7 to use the Auto Smelter!");
                                break;
                            case 28:
                                // Auto Sell
                                if ($this->canUseAutoSell()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isAutoSell()) {
                                        $this->getMinionInformation()->getUpgrade()->setAutoSell(true);

                                        $player->sendMessage("§8(§b!§8) §7Auto Sell upgrade enabled!");
                                        break;
                                    } elseif ($this->money > 0) {
                                        EconomyAPI::getInstance()->addMoney($player, $this->money);
                                        $player->sendMessage("§8(§b!§8) §7Successfully withdrew an amount of§e $this->money §7from the minion!");
                                        $this->money = 0;
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setAutoSell(false);

                                    $player->sendMessage("§8(§b!§8) §7Auto Sell upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§8(§b!§8) §7You need to upgrade your minion to level §e" . MinionUpgrade::AUTO_SELL_LEVEL . "§7 to use the Auto Sell!");
                                break;
                            case 37:
                                // Super Compacter
                                if ($this->canUseCompacter()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isSuperCompacter()) {
                                        $this->getMinionInformation()->getUpgrade()->setSuperCompacter(true);

                                        $player->sendMessage("§8(§b!§8) §7Super Compacter upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setSuperCompacter(false);

                                    $player->sendMessage("§8(§b!§8) §7Super Compacter upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§8(§b!§8) §7You need to upgrade your minion to level §e" . MinionUpgrade::SUPER_COMPACTER_LEVEL . "§7 to use the Super Compacter!");
                                break;
                            case 46:
                                // Super Expander
                                if ($this->canUseExpander()) {
                                    $player->removeCurrentWindow();
                                    if (!$this->getMinionInformation()->getUpgrade()->isSuperExpander()) {
                                        $this->getMinionInformation()->getUpgrade()->setSuperExpander(true);

                                        $player->sendMessage("§8(§b!§8) §7Super Expander upgrade enabled!");
                                        break;
                                    }
                                    $this->getMinionInformation()->getUpgrade()->setSuperExpander(false);

                                    $player->sendMessage("§8(§b!§8) §7Super Expander upgrade disabled!");
                                    break;
                                }
                                $player->sendMessage("§8(§b!§8) §7You need to upgrade your minion to level §e" . MinionUpgrade::SUPER_EXPANDER_LEVEL . "§7 to use the Super Expander!");
                                break;
                            case 48:
                                // Collect All
                                foreach ($this->getMinionInventory()->getContents() as $slot => $item) {
                                    if ($player->getInventory()->canAddItem($item)) {
                                        $player->getInventory()->addItem($item);
                                        $this->getMinionInventory()->setItem($slot, VanillaBlocks::AIR()->asItem());
                                        continue;
                                    }
                                    $player->sendMessage('§8(§b!§8) §7Your Inventory Is Full, Empty It Before Making A Transaction');
                                    break;
                                }
                                break;
                            case 50:
                                // Level Up
                                $player->removeCurrentWindow();
                                if ($this->getMinionInformation()->getLevel() < 15) {
                                    $playerMoney = EconomyAPI::getInstance()->myMoney($player);
                                    if (is_bool($playerMoney)) {
                                        break;
                                    }

                                    if ($playerMoney - $this->getLevelUpCost() >= 0) {
                                        EconomyAPI::getInstance()->reduceMoney($player, $this->getLevelUpCost());
                                        $this->getMinionInformation()->incrementLevel();
                                        $player->sendMessage('§8(§b!§8) §7Your Minion Has Been Upgraded To Level§e ' . TextFormat::GOLD . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()));
                                        $this->getMinionInventory()->setSize($this->getMinionInformation()->getLevel());
                                        $this->stopWorking();
                                        break;
                                    }
                                    $player->sendMessage("§8(§b!§8) §7You Don't Have Enough Money For Upgrade Minion");
                                    break;
                                }
                                $player->sendMessage('§8(§b!§8) §7Your Minion Has Reached The Maximum Level');
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
                                            foreach (array_reverse($this->getMinionInventory()->all($itemClicked), true) as $index => $item) {
                                                $itemCount = $item->getCount();
                                                $this->getMinionInventory()->setItem($index, $item->setCount(max($itemCount - $remaining, 0)));
                                                $remaining -= $itemCount;
                                                if ($remaining === 0) {
                                                    break;
                                                }
                                            }
                                        } else {
                                            $player->removeCurrentWindow();
                                            $player->sendMessage('§8(§b!§8) §7Your Inventory Is Full, Empty It Before Making A Transaction');
                                        }
                                    }
                                }
                                break;
                        }
                        for ($i = 0; $i < 15; ++$i) {
                            $action->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : ItemFactory::getInstance()->get(1080, 0, 1)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }
                    }));
                    $menu->setInventoryCloseListener(function (Player $player, Inventory $inventory): void {
                        $this->isViewingInv = false;
                    });
                    $menu->send($damager, null, function () use ($menu): void {
                        $this->isViewingInv = true;

                        $menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(1081, 0, 1)->setCustomName(TextFormat::RESET)));
                        for ($i = 0; $i < 15; ++$i) {
                            $menu->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : ItemFactory::getInstance()->get(1080, 0, 1)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }

                        $types = ['Mining', 'Farming', 'Lumberjack', 'Slaying', 'Fishing'];
                        $menu->getInventory()->setItem(4, ItemFactory::getInstance()->get(ItemIds::SKULL, 3)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()))->setLore([
                            '§r§6Type: ' . TextFormat::WHITE . $types[$this->getMinionInformation()->getType()->getActionType()],
                            '§r§6Target: ' . TextFormat::WHITE . $this->getMinionInformation()->getType()->getTargetName(),
                            '§r§6Level: ' . TextFormat::WHITE . $this->getMinionInformation()->getLevel(),
                            '§r§6Resources Collected: ' . TextFormat::WHITE . $this->getMinionInformation()->getResourcesCollected(),
                        ]));

                        // Auto Smelter
                        if ($this->canUseAutoSmelt()) {
                            $furnaceItem = VanillaBlocks::FURNACE()->asItem();
                            $menu->getInventory()->setItem(19, $furnaceItem->setCustomName('§r§l§eAuto Smelter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSmelt() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Smelts Items That\n§r§7The Minion Produces"]));
                        } else {
                            $menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(1101, 0, 1)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::AUTO_SMELT_LEVEL . " to use the Auto Smelter!"));
                        }

                        // Auto Seller
                        if ($this->canUseAutoSell()) {
                            $hopper = VanillaBlocks::HOPPER()->asItem();
                            $menu->getInventory()->setItem(28, $hopper->setCustomName('§r§l§eAuto Seller §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSell() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Sell Automatically Resources When\n§r§7The Minion's Storage Is Full", "§r§l§dTotal Money: §f" . $this->money]));
                        } else {
                            $menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(1101, 0, 1)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::AUTO_SELL_LEVEL . " to use the Auto Seller!"));
                        }

                        // Super Compacter
                        if ($this->canUseCompacter()) {
                            $dispenser = ItemFactory::getInstance()->get(23, 0, 1);
                            $menu->getInventory()->setItem(37, $dispenser->setCustomName('§r§l§eCompacter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isSuperCompacter() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Convert Items Into\n§r§7Block From This Upgrade"]));
                        } else {
                            $menu->getInventory()->setItem(37, ItemFactory::getInstance()->get(1101, 0, 1)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_COMPACTER_LEVEL . " to use the Super Compacter!"));
                        }

                        // Super Expander
                        if ($this->canUseExpander()) {
                            $commandBlock = ItemFactory::getInstance()->get(137, 0, 1);
                            $commandBlock->addEnchantment($this->fakeEnchant);

                            $menu->getInventory()->setItem(46, $commandBlock->setCustomName('§r§l§eExpander §l§7(' . ($this->getMinionInformation()->getUpgrade()->isSuperExpander() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Increases The Minion Range\n§r§7By One Block To High Blocks"]));
                        } else {
                            $menu->getInventory()->setItem(46, ItemFactory::getInstance()->get(1101, 0, 1)->setCustomName("§r§cYou need to upgrade your minion to level " . MinionUpgrade::SUPER_EXPANDER_LEVEL . " to use the Super Expander!"));
                        }

                        $menu->getInventory()->setItem(48, ItemFactory::getInstance()->get(1103, 0, 1)->setCustomName("§r§l§eCOLLECT ITEMS\n\n§r§7Click To Collect All Items From\n§r§7Your Minion Inventory To Your\n§r§7Inventory.\n\n§r§dClick To Collect"));
                        $menu->getInventory()->setItem(50, ItemFactory::getInstance()->get(1102, 0, 1)->setCustomName("§r§l§eUPGRADE MINION\n\n§r§7Click To Upgrade Your Minion\n§r§7Level 1 To High Levels For\n§r§7Open Inventory Slots.\n\n§r§dClick To Upgrade")->setLore([$this->getMinionInformation()->getLevel() < 15 ? "§r§l§6AMOUNT: §r§e" . TextFormat::GREEN . $this->getLevelUpCost() . "$" : TextFormat::LIGHT_PURPLE . "Reached Max Level"]));
                        $menu->getInventory()->setItem(52, ItemFactory::getInstance()->get(1104, 0, 1)->setCustomName("§r§l§ePICKUP MINION\n\n§r§7Click To Pickup Your Minion\n§r§7To Move In New Location\n\n§r§dClick To Pickup"));
                        $menu->getInventory()->setItem(6, ItemFactory::getInstance()->get(ItemIds::GOLD_INGOT)->setCustomName("§r§e§lCOMMING SOON"));
                        $menu->getInventory()->setItem(5, ItemFactory::getInstance()->get(ItemIds::ENDER_EYE)->setCustomName("§r§l§eTOTAL UPGRADE AMOUNT\n§r§aLevel 1: §r§d0\n§r§aLevel 2: §r§d1000$\n§r§aLevel 3: §r§d2000$\n§r§aLevel 4: §r§d4000$\n§r§aLevel 5: §r§d8000$\n§r§aLevel 6: §r§d12000$\n§r§aLevel 7: §r§d15000$\n§r§aLevel 8: §r§d17500$\n§r§aLevel 9: §r§d20000$\n§r§aLevel 10: §r§d22000$\n§r§aLevel 11: §r§d25000$\n§r§aLevel 12: §r§d27000$\n§r§aLevel 13: §r§d30000$\n§r§aLevel 14: §r§d35000$\n§r§aLevel 15: §r§d40000$"));
                    });
                }
            }
        }
        $source->cancel();
    }

    /**
     * entityBaseTick
     *
     * @see PLEASE READ MESSAGE IN METHOD BEFORE DOING ANYTHING TO THIS!
     */
    public function entityBaseTick(int $tickDiff = 1): bool
    {
        // █▀█ █░░ █▀▀ ▄▀█ █▀ █▀▀   █▀█ █▀▀ ▄▀█ █▀▄
        // █▀▀ █▄▄ ██▄ █▀█ ▄█ ██▄   █▀▄ ██▄ █▀█ █▄▀
        // 
        // In order to reduce the amount of lag made by minions, I have decided to downgrade the tick rate of the minions.
        // The entityBaseTick method is called every tick, and it is the method that is responsible for the most of the lag.
        // I have made it such that the tick rate is increased by a factor of 20.
        // If you are reading this, please do not do anything to this method.
        // 
        // The minion has also been stripped off of non necessary methods.

        $hasUpdate = false;

        $this->ticksLived += $tickDiff;
        Timings::$livingEntityBaseTick->startTiming();

        // █▀▀ █▄░█ ▀█▀ █ ▀█▀ █▄█
        // ██▄ █░▀█ ░█░ █ ░█░ ░█░

        if ($this->justCreated) {
            $this->justCreated = false;
            if (!$this->isAlive()) {
                $this->kill();
            }
        }

        $changedProperties = $this->getDirtyNetworkData();
        if (count($changedProperties) > 0) {
            $this->sendData(null, $changedProperties);
            $this->getNetworkProperties()->clearDirtyProperties();
        }

        if ($this->location->y <= World::Y_MIN - 16 && $this->isAlive()) {
            $this->destroy();
            $hasUpdate = true;
        }

        // █▀▄▀█ █ █▄░█ █ █▀█ █▄░█  █▀▀ █▄░█ ▀█▀ █ ▀█▀ █▄█
        // █░▀░█ █ █░▀█ █ █▄█ █░▀█  ██▄ █░▀█ ░█░ █ ░█░ ░█░

        if (!$this->closed && !$this->isFlaggedForDespawn() && isset($this->minionInformation) && !$this->isViewingInv) {
            if ($this->ticksLived % 60 === 0) {
                $this->updateTarget();
            }
            if (!$this->checkFull()) {
                return $hasUpdate;
            }

            ++$this->currentActionSeconds;
            if (!$this->isWorking) {
                $this->getTarget();
                $this->isWorking = true;
            }

            $this->getWorld()->requestChunkPopulation($this->target->getPosition()->getX() >> Chunk::COORD_BIT_SIZE, $this->target->getPosition()->getZ() >> Chunk::COORD_BIT_SIZE, null);
            if (!$this->checkTarget()) {
                $this->stopWorking();
                return $hasUpdate;
            }

            switch ($this->currentAction) {
                case self::ACTION_IDLE:
                    if ($this->currentActionSeconds >= 2) { //TODO: Customize
                        $this->setNameTag($this->getMinionInformation()->getOwner() . " Minion");
                        $this->setNameTagAlwaysVisible(false);
                        
                        $this->currentAction = self::ACTION_TURNING;
                        $this->currentActionSeconds = 0;
                    }
                    break;
                case self::ACTION_TURNING:
                    $this->lookAt($this->target->getPosition());
                    if ($this->currentActionSeconds === 1) {
                        $this->currentAction = self::ACTION_WORKING;
                        $this->currentActionSeconds = 0;
                    }
                    break;
                case self::ACTION_WORKING:
                    $isPlacing = $this->target instanceof Air;
                    if (!$isPlacing) {
                        if ($this->currentActionSeconds === 1 && $this->broadcastPlaceBreak()) {
                            $this->getWorld()->broadcastPacketToViewers($this->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_START_BREAK, (int) (65535 / 60), $this->target->getPosition()));
                        }
                        if ($this->isWorkFast()) {
                            $this->startWorking();
                        }
                        $pk = new AnimatePacket();
                        $pk->action = AnimatePacket::ACTION_SWING_ARM;
                        $pk->actorRuntimeId = $this->getId();
                        if ($this->broadcastPlaceBreak()) {
                            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), $pk);
                        }
                    } elseif ($this->broadcastPlaceBreak()) {
                        $this->getWorld()->broadcastPacketToViewers($this->target->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
                    }
                    if ($this->currentActionSeconds === 2) {
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
                        $this->setNameTag($this->getMinionInformation()->getOwner() . " Minion");
                    }
                    break;
            }
        }
        Timings::$livingEntityBaseTick->stopTiming();

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

        $listTag = $nbt->getTag('MinionInformation');
        if (!$listTag instanceof ListTag) {
            return;
        }

        $this->minionInformation = MinionInformation::nbtDeserialize($listTag);
        $this->minionInventory = new MinionInventory(15);
        $this->minionInventory->setSize($this->minionInformation->getLevel());
        $this->money = $nbt->getFloat('Money', 0);

        /** @phpstan-ignore-next-line */
        $this->fakeEnchant = new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BetterMinion::FAKE_ENCH_ID));
        $this->target = VanillaBlocks::AIR();

        $invTag = $nbt->getTag('MinionInventory');
        if ($invTag instanceof ListTag) {
            /** @var array<CompoundTag> $itemTags */
            $itemTags = $invTag->getValue();
            $this->minionInventory->setContents(array_map(
                fn (CompoundTag $itemTag) => Item::nbtDeserialize($itemTag),
                $itemTags
            ));
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

        $this->setNameTag($this->getMinionInformation()->getOwner() . " Minion");
        $this->setNameTagAlwaysVisible(false);
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

    protected function compactItems(): ?Item
    {
        $contents = file_get_contents(BetterMinion::getInstance()->getDataFolder() . 'compacts.json');
        if (!is_string($contents)) {
            return null;
        }

        foreach ($this->getMinionInventory()->getContents() as $index => $item) {
            if ($item->getCount() > 9) {
                $compactItems = json_decode($contents, true);
                foreach ($compactItems as $input => $output) {
                    $realInput =  StringToItemParser::getInstance()->parse($input) ?? LegacyStringToItemParser::getInstance()->parse($input);
                    $realOutput = StringToItemParser::getInstance()->parse($output) ?? LegacyStringToItemParser::getInstance()->parse($output);

                    if ($item->equals($realInput) && $this->getMinionInventory()->canAddItem($realOutput)) {
                        $item->setCount($item->getCount() - 9);
                        $this->getMinionInventory()->setItem($index, $item);
                        $this->getMinionInventory()->addItem($realOutput);
                        return $item;
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
        return $drops;
    }

    protected function updateTarget(): void
    {
    }

    abstract protected function getTarget(): void;

    protected function checkTarget(): bool
    {
        return $this->target instanceof Air || ($this->target->getId() === $this->getMinionInformation()->getType()->getTargetId() && $this->target->getMeta() === $this->getMinionInformation()->getType()->getTargetMeta());
    }

    protected function startWorking(): void
    {
        $this->getWorld()->addParticle($this->target->getPosition()->add(0.5, 0.5, 0.5), new BlockBreakParticle($this->target));
        $this->getWorld()->setBlock($this->target->getPosition(), $this->target instanceof Air ? $this->getMinionInformation()->getType()->toBlock() : VanillaBlocks::AIR());
        if (!$this->target instanceof Air) {
            $drops = $this->getTargetDrops();
            foreach ($drops as $drop) {
                if ($drop instanceof Item) {
                    for ($i = 1; $i <= $drop->getCount(); ++$i) {
                        $thing = ItemFactory::getInstance()->get($drop->getId(), $drop->getMeta());
                        if ($this->getMinionInventory()->canAddItem($thing)) {
                            $this->getMinionInventory()->addItem($thing);
                            $this->getMinionInformation()->incrementResourcesCollected();

                            if ($this->getMinionInformation()->getUpgrade()->isSuperCompacter()) {
                                $this->compactItems();
                            }
                        }
                    }
                }
            }
        }
    }

    protected function stopWorking(): void
    {
        $this->currentAction = self::ACTION_IDLE;
        $this->currentActionSeconds = 0;

        if ($this->broadcastPlaceBreak()) {
            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
        }
        $this->isWorking = false;
    }

    protected function isInventoryFull(): bool
    {
        $full = true;
        $drops = $this->getTargetDrops();

        foreach ($drops as $item) {
            if ($item instanceof Item) {
                if ($this->getMinionInventory()->canAddItem($item)) {
                    $full = false;
                    break;
                }
            }
        }
        return $full;
    }

    private function destroy(): void
    {
        if ($this->broadcastPlaceBreak()) {
            $this->getWorld()->broadcastPacketToViewers($this->getPosition(), LevelEventPacket::create(LevelEvent::BLOCK_STOP_BREAK, 0, $this->target->getPosition()));
        }
        foreach ($this->getMinionInventory()->getContents() as $content) {
            $this->getWorld()->dropItem($this->getPosition(), $content);
        }

        if (!BetterMinion::getInstance()->getProvider()->hasMinionData($this->getMinionInformation()->getOwner())) {
            BetterMinion::getInstance()->getProvider()->createMinionData($this->getMinionInformation()->getOwner());
        }
        $minionData = BetterMinion::getInstance()->getProvider()->getMinionDataFromPlayer($this->getMinionInformation()->getOwner());
        BetterMinion::getInstance()->getProvider()->updateMinionData($this->getMinionInformation()->getOwner(), $minionData["minionCount"] <= 0 ? 0 : $minionData["minionCount"] - 1);

        $minionItem = ItemFactory::getInstance()->get(1098, 0, 1);
        $minionItem->setCustomName(TextFormat::RESET . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()))->setLore(["§r§7Place this minion and it will\n§r§7start generating and mining blocks!\n§r§7Requires an open area to spawn\n§r§7blocks. Minions also work when you are offline!\n\n§r§eType: §b" . $this->getMinionInformation()->getType()->getTargetName() . "\n§r§eLevel: §b" . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()) . "\n§r§eResources Collected: §b" . $this->getMinionInformation()->getResourcesCollected() . ""]);
        $minionItem->addEnchantment($this->fakeEnchant);
        $minionItem->getNamedTag()->setTag("MinionInformation", $this->minionInformation->nbtSerialize());

        $this->getWorld()->dropItem($this->getPosition(), $minionItem);
        $this->close();

        $player = Server::getInstance()->getPlayerExact($this->getMinionInformation()->getOwner());
        if ($player instanceof Player) {
            $player->sendMessage("§8(§b!§8) §7Minion successfully destroyed! You have " . ($minionData["minionCount"] - 1) . "/" . BetterMinion::MINION_LIMIT . " minions now!");
        }
    }

    protected function getTool(string $tool, bool $isNetheriteTool): ?Item
    {
        $tools = [
            BlockToolType::NONE => $isNetheriteTool ? ItemFactory::getInstance()->get(745) : StringToItemParser::getInstance()->parse($tool . ' Pickaxe'),
            BlockToolType::SHOVEL => $isNetheriteTool ? ItemFactory::getInstance()->get(744) : StringToItemParser::getInstance()->parse($tool . ' Shovel'),
            BlockToolType::PICKAXE => $isNetheriteTool ? ItemFactory::getInstance()->get(745) : StringToItemParser::getInstance()->parse($tool . ' Pickaxe'),
            BlockToolType::AXE => $isNetheriteTool ? ItemFactory::getInstance()->get(746) : StringToItemParser::getInstance()->parse($tool . ' Axe'),
            BlockToolType::HOE => $isNetheriteTool ? ItemFactory::getInstance()->get(747) : StringToItemParser::getInstance()->parse($tool . ' Hoe'),
            BlockToolType::SHEARS => ItemFactory::getInstance()->get(ItemIds::SHEARS),
        ];

        return $tools[$this->getMinionInformation()->getType()->toBlock()->getBreakInfo()->getToolType()];
    }

    private function checkFull(): bool
    {
        if ($this->isInventoryFull()) {
            if ($this->getMinionInformation()->getUpgrade()->isAutoSell()) {
                $this->sellItems();
                return true;
            }
            $this->currentAction = self::ACTION_CANT_WORK;
            $this->setNameTag("\n\n§cInventory Full");
            $this->setNameTagAlwaysVisible();
            return false;
        }
        return true;
    }

    private function getRealDrops(): array
    {
        $block = $this->getMinionInformation()->getType()->toBlock();
        $drops = $block->getDropsForCompatibleTool(VanillaItems::AIR());
        if (count($drops) === 0) {
            $drops = $block->getSilkTouchDrops(VanillaItems::AIR());
        }
        return $drops;
    }

    private function sellItems(): void
    {
        $sellPrices = SellAll::getInstance()->getConfig()->getAll();

        $item = $this->getMinionInventory()->getItem($this->getMinionInventory()->getSize() - 1);
        if (isset($sellPrices[$item->getId()])) {
            $this->money += $sellPrices[$item->getId()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        } elseif (isset($sellPrices[$item->getId() . ':' . $item->getMeta()])) {
            $this->money += $sellPrices[$item->getId() . ':' . $item->getMeta()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        }
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

    protected function broadcastPlaceBreak(): bool
    {
        return true;
    }

    protected function isWorkFast(): bool
    {
        return false;
    }
}
