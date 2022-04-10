<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\entities;

use function floor;
use function intval;
use function explode;
use pocketmine\Player;
use function array_map;
use function array_fill;
use function json_decode;
use pocketmine\item\Item;
use function array_reverse;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\MenuIds;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\block\Block;
use pocketmine\utils\Color;
use pocketmine\entity\Human;
use pocketmine\item\ItemIds;
use pocketmine\entity\Living;
use pocketmine\block\BlockIds;
use function file_get_contents;
use pocketmine\nbt\tag\ListTag;
use pocketmine\utils\TextFormat;
use onebone\economyapi\EconomyAPI;
use pocketmine\inventory\Inventory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EffectInstance;
use pocketmine\scheduler\ClosureTask;
use BhawaniSingh\HCMinion\utils\Utils;
use BhawaniSingh\HCMinion\BetterMinion;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use BhawaniSingh\HCMinion\minions\MinionInformation;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use BhawaniSingh\HCMinion\entities\inventory\MinionInventory;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;

abstract class MinionEntity extends Human
{
    public const ACTION_CANT_WORK = -1;
    public const ACTION_IDLE = 0;
    public const ACTION_TURNING = 1;
    public const ACTION_WORKING = 2;

    /** @var MinionInformation */
    protected $minionInformation;
    /** @var MinionInventory */
    protected $minionInventory;
    /** @var int */
    protected $currentAction = self::ACTION_IDLE;
    /** @var int */
    protected $currentActionTicks = 0;
    /** @var null|Block|Living */
    protected $target;
    /** @var float */
    protected $gravity = 0;
    /** @var float */
    private $money;

    public function saveNBT(): void
    {
        parent::saveNBT();
        $this->namedtag->setTag(new ListTag('MinionInventory', array_map(function (Item $item): CompoundTag {
            return $item->nbtSerialize();
        }, $this->minionInventory->getContents())));
        $this->namedtag->setTag($this->minionInformation->nbtSerialize());
        $this->namedtag->setFloat('Money', $this->money);
    }

    public function attack(EntityDamageEvent $source): void
    {
        if ($source instanceof EntityDamageByEntityEvent) {
            $damager = $source->getDamager();
            if ($damager instanceof Player) {
                if (isset(BetterMinion::getInstance()->isRemove[$damager->getName()])) {
                    unset(BetterMinion::getInstance()->isRemove[$damager->getName()]);
                    $damager->sendMessage('Successfully removed ' . $this->getMinionInformation()->getOwner() . "'s minion");
                    $this->destroy();

                    return;
                }
                if ($damager->getName() === $this->getMinionInformation()->getOwner()) {
                    $menu = InvMenu::create(MenuIds::TYPE_DOUBLE_CHEST);
                    $menu->setName("§r§l§eMINION INVENTORY");
                    $item1 = Item::get(61, 0, 1);
                    $item1->setNamedTagEntry(new ListTag("ench"));
                    $item2 = Item::get(23, 0, 1);
                    $item2->setNamedTagEntry(new ListTag("ench"));
                    $item3 = Item::get(410, 0, 1);
                    $item3->setNamedTagEntry(new ListTag("ench"));
                    $item4 = Item::get(137, 0, 1);
                    $item4->setNamedTagEntry(new ListTag("ench"));
                    $menu->getInventory()->setContents(array_fill(0, 54, Item::get(BlockIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
                    if ($this->canUseAutoSmelter()) {
                        $menu->getInventory()->setItem(19, $item1->setCustomName('§r§l§eAuto Smelter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSmelt() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Smelts Items That\n§r§7The Minion Produces", '§r§l§aResult: ' . TextFormat::BOLD . TextFormat::GOLD . $this->getSmeltedTarget()->getVanillaName() . "\n" . ($this->getMinionInformation()->getUpgrade()->isAutoSmelt() ? "§r§bAlready Enabled" : "§r§bUse Super Smelter For Enable")]));
                    } else {
                        $menu->getInventory()->setItem(19, Item::get(BlockIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cThis Minion Cannot Use This Upgrade"));
                    }
                    if ($this->canUseCompacter()) {
                        $menu->getInventory()->setItem(28, $item2->setCustomName('§r§l§eCompacter §l§7(' . ($this->getMinionInformation()->getUpgrade()->isCompact() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Automatically Convert Items Into\n§r§7Block From This Upgrade\n" . ($this->getMinionInformation()->getUpgrade()->isCompact() ? "§r§bAlready Enabled" : "§r§bUse Super Compacter For Enable")]));
                    } else {
                        $menu->getInventory()->setItem(28, Item::get(BlockIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cThis Minion Cannot Use This Upgrade"));
                    }
                    $menu->getInventory()->setItem(37, $item3->setCustomName('§r§l§eAuto Seller §l§7(' . ($this->getMinionInformation()->getUpgrade()->isAutoSell() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Sell Automatically Resources When\n§r§7The Minion's Storage Is Full", "§r§l§dTotal Money: §f" . $this->money]));
                    if ($this->canUseExpander()) {
                        $menu->getInventory()->setItem(46, $item4->setCustomName('§r§l§eExpander §l§7(' . ($this->getMinionInformation()->getUpgrade()->isExpand() ? "§r§l§aEnabled" : "§r§l§cDisabled") . '§l§7)')->setLore(["§r§7Increases The Minion Range\n§r§7By One Block To High Blocks\n" . ($this->getMinionInformation()->getUpgrade()->isExpand() ? "§r§bAlready Enabled" : "§r§bUse Super Expander For Enable")]));
                    } else {
                        $menu->getInventory()->setItem(46, Item::get(BlockIds::STAINED_GLASS_PANE, 14)->setCustomName("§r§cThis Minion Cannot Use This Upgrade"));
                    }
                    $menu->getInventory()->setItem(48, Item::get(54, 0, 1)->setCustomName("§r§l§eCollect Items\n\n§r§7Click To Collect All Items From\n§r§7Your Minion Inventory To Your\n§r§7Inventory.\n\n§r§l§dClick To Collect"));
                    $menu->getInventory()->setItem(50, Item::get(ItemIds::NETHER_STAR)->setCustomName("§r§l§eUpgrade Minion\n\n§r§7Click To Upgrade Your Minion\n§r§7Level 1 To High Levels For\n§r§7Open Inventory Slots.\n\n§r§l§dClick To Upgrade")->setLore([$this->getMinionInformation()->getLevel() < 15 ? "§r§l§6Amount: " . TextFormat::GREEN . $this->getLevelUpCost() . "$" : TextFormat::LIGHT_PURPLE . "Reached Max Level"]));
                    $menu->getInventory()->setItem(52, Item::get(7, 0, 1)->setCustomName("§r§l§ePickup Minion\n\n§r§7Click To Pickup Your Minion\n§r§7To Move In New Location\n\n§r§l§dClick To Pickup"));
                    $menu->getInventory()->setItem(6, Item::get(ItemIds::GOLD_INGOT)->setCustomName("§r§e§lCOMMING SOON"));
                    $menu->getInventory()->setItem(5, Item::get(ItemIds::ENDER_EYE)->setCustomName("§r§l§eTOTAL UPGRADE AMOUNT\n§r§aLevel 1: §r§d0\n§r§aLevel 2: §r§d2000$\n§r§aLevel 3: §r§d4000$\n§r§aLevel 4: §r§d8000$\n§r§aLevel 5: §r§d10000$\n§r§aLevel 6: §r§d12500$\n§r§aLevel 7: §r§d15000$\n§r§aLevel 8: §r§d17500$\n§r§aLevel 9: §r§d20000$\n§r§aLevel 10: §r§d25000$\n§r§aLevel 11: §r§d30000$\n§r§aLevel 12: §r§d35000$\n§r§aLevel 13: §r§d40000$\n§r§aLevel 14: §r§d50000$\n§r§aLevel 15: §r§d100000$"));
                    $taskId = BetterMinion::getInstance()->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (int $currentTick) use ($menu): void {
                        for ($i = 0; $i < 15; ++$i) {
                            $menu->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : Item::get(BlockIds::STAINED_GLASS_PANE)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }
                        $types = ['Mining', 'Farming', 'Lumberjack', 'Slaying', 'Fishing'];
                        $menu->getInventory()->setItem(4, Item::get(ItemIds::SKULL, 3)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()))->setLore([
                            '§r§6Type: ' . TextFormat::WHITE . $types[$this->getMinionInformation()->getType()->getActionType()],
                            '§r§6Target: ' . TextFormat::WHITE . $this->getMinionInformation()->getType()->getTargetName(),
                            '§r§6Level: ' . TextFormat::WHITE . $this->getMinionInformation()->getLevel(),
                            '§r§6Resources Collected: ' . TextFormat::WHITE . $this->getMinionInformation()->getResourcesCollected(),
                        ]));
                    }), 20)->getTaskId();
                    $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {
                        $player = $transaction->getPlayer();
                        $hand = $player->getInventory()->getItemInHand();
                        $itemClicked = $transaction->getItemClicked();
                        $action = $transaction->getAction();

                        switch ($action->getSlot()) {
                            case 6: 
                              
                              break;
                            case 19:
                                if ($this->canUseAutoSmelter()) {
                                    $player->removeWindow($action->getInventory());
                                        if($hand->getCustomName() === "§r§l§eSUPER SMELTER§r§r\n\n§r§7Use This Super Smelter For Enable\n§r§7Auto Smelter Upgrade In Your Any Minion.") {
        $player->getInventory()->remove($hand);
                   
                     $player->sendMessage("§aYou Successfully Enabled This Auto Smelter Upgrade");
         
     $this->getMinionInformation()->getUpgrade()->setAutoSmelt();
                                        $this->stopWorking();
           
       } else {
                                      $player->sendMessage("§cYou Don't Have Super Smelter For Enabled This Upgrade");
                                    }
                                }

                                break;

                            case 28:
                                if ($this->canUseCompacter()) {
                                    $player->removeWindow($action->getInventory());
    
                                    if($hand->getCustomName() === "§r§l§eSUPER COMPACTER§r§r\n\n§r§7Use This Super Compacter For Enable\n§r§7Compacter Upgrade In Your Any Minion.") {
        $player->getInventory()->remove($hand);
                        
                     $player->sendMessage("§aYou Successfully Enabled This Compacter Upgrade");
                   
         $this->getMinionInformation()->getUpgrade()->setCompact();
                                        $this->stopWorking();
                
         } else {
                                      $player->sendMessage("§cYou Don't Have Super Compacter For Enabled This Upgrade");
                                    }
                      }

                                break;
                                
                                case 37:
                                  $player->removeWindow($action->getInventory());
                                if (!$this->getMinionInformation()->getUpgrade()->isAutoSell()) {
                                    if (EconomyAPI::getInstance()->myMoney($player) - $this->getAutoSellCost() >= 0) {
                                        EconomyAPI::getInstance()->reduceMoney($player, $this->getAutoSellCost());
                                        $this->getMinionInformation()->getUpgrade()->setAutoSell();
                                        $this->stopWorking();
                                    }
                                } else {
                                    EconomyAPI::getInstance()->addMoney($player, $this->money);
                                    $this->money = 0;
                                }
                                
                                break;
                                
                            case 46:
                              if ($this->canUseExpander()) {
                                    $player->removeWindow($action->getInventory());
    
                                    if($hand->getCustomName() === "§r§l§eSUPER EXPANDER§r§r\n\n§r§7Use This Super Expander For Enable\n§r§7Expander Upgrade In Your Any Minion.") {
        $player->getInventory()->remove($hand);
                        
                     $player->sendMessage("§aYou Successfully Enabled This Expander Upgrade");
                   
         $this->getMinionInformation()->getUpgrade()->setExpand();
                                        $this->stopWorking();
                
         } else {
           
           $player->sendMessage("§cYou Don't Have Super Expander For Enabled This Upgrade");
                                    }
                      }

                                break;

                            case 48:
                                foreach (array_reverse($this->getMinionInventory()->getContents(), true) as $slot => $item) {
                                    if ($player->getInventory()->canAddItem($item)) {
                                        $player->getInventory()->addItem($item);
                                        $this->getMinionInventory()->setItem($slot, Item::get(BlockIds::AIR));
                                    } else {
                                        $player->sendMessage(TextFormat::RED . 'Your Inventory Is Full, Empty It Before Making A Transaction');
                                    }
                                }

                                break;

                            case 50:
                                $player->removeWindow($action->getInventory());
                                if ($this->getMinionInformation()->getLevel() < 15) {
                                    if (EconomyAPI::getInstance()->myMoney($player) - $this->getLevelUpCost() >= 0) {
                                        EconomyAPI::getInstance()->reduceMoney($player, $this->getLevelUpCost());
                                        $this->getMinionInformation()->incrementLevel();
                                        $player->sendMessage(TextFormat::GREEN . 'Your Minion Has Been Upgraded To Level ' . TextFormat::GOLD . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()));
                                        $this->getMinionInventory()->setSize($this->getMinionInformation()->getLevel());
                                        $this->stopWorking();
                                    } else {
                                        $player->sendMessage(TextFormat::RED . "You Don't Have Enough Money For Upgrade Minion");
                                    }
                                 } else {
                                    $player->sendMessage(TextFormat::RED . 'Your Minion Has Reached The Maximum Level');
                                }

                                break;

                            case 52:
                                $player->removeWindow($action->getInventory());
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
                                                $this->getMinionInventory()->setItem($slot, $item->setCount($itemCount - $remaining > 0 ? $itemCount - $remaining : 0));
                                                $remaining -= $itemCount;
                                                if ($remaining === 0) {
                                                    break;
                                                }
                                            }
                                        } else {
                                            $player->removeWindow($action->getInventory());
                                            $player->sendMessage(TextFormat::RED . 'Your Inventory Is Full, Empty It Before Making A Transaction');
                                        }
                                    }
                                }

                                break;
                        }
                        for ($i = 0; $i < 15; ++$i) {
                            $action->getInventory()->setItem((int) (21 + ($i % 5) + (9 * floor($i / 5))), $this->getMinionInventory()->slotExists($i) ? $this->getMinionInventory()->getItem($i) : Item::get(BlockIds::STAINED_GLASS_PANE)->setCustomName(TextFormat::RESET . TextFormat::GOLD . 'Unlock At Level ' . TextFormat::AQUA . Utils::getRomanNumeral(($i + 1))));
                        }
                    }));
                    $menu->send($damager);
                    $menu->setInventoryCloseListener(function (Player $player, Inventory $inventory) use ($taskId): void {
                        BetterMinion::getInstance()->getScheduler()->cancelTask($taskId);
                    });
                }
            }
        }
        $source->setCancelled();
    }

    public function entityBaseTick(int $tickDiff = 1): bool
    {
        $hasUpdate = parent::entityBaseTick($tickDiff);
        if (!$this->closed && !$this->isFlaggedForDespawn()) {
            if ($this->ticksLived % 60 === 0) {
                $this->updateTarget();
            }
            if (!$this->checkFull()) {
                return $hasUpdate;
            }
            if ($this->target === null) {
                $this->getTarget();
            }
            ++$this->currentActionTicks;
            if ($this->target instanceof Block) {
                $this->target = $this->level->getBlock($this->target);
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
                    $this->lookAt($this->target->multiply($this->currentActionTicks / 5));
                    if ($this->currentActionTicks === 5) {
                        $this->currentAction = self::ACTION_WORKING;
                        $this->currentActionTicks = 0;
                    }

                    break;

                case self::ACTION_WORKING:
                    $isPlacing = $this->target->getId() === BlockIds::AIR;
                    if (!$isPlacing) {
                        if ($this->currentActionTicks === 1) {
                            $this->level->broadcastLevelEvent($this->target, LevelEventPacket::EVENT_BLOCK_START_BREAK, (int) (65535 / 60));
                        }
                        if ($this->isWorkFast() && $this->currentActionTicks === 2) {
                            $this->startWorking();
                        }
                        $pk = new AnimatePacket();
                        $pk->action = AnimatePacket::ACTION_SWING_ARM;
                        $pk->entityRuntimeId = $this->getId();
                        $this->level->broadcastPacketToViewers($this, $pk);
                    } else {
                        $this->level->broadcastLevelEvent($this->target, LevelEventPacket::EVENT_BLOCK_STOP_BREAK);
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
                        $this->setNameTag($this->getMinionInformation()->getType()->getTargetName(). " Minion");
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

    protected function initEntity(): void
    {
        parent::initEntity();
        $this->setScale(0.550);
        $this->setImmobile();
        $this->setNameTagAlwaysVisible();
        $this->minionInformation = MinionInformation::nbtDeserialize($this->namedtag->getCompoundTag('MinionInformation'));
        $this->minionInventory = new MinionInventory();
        $this->minionInventory->setSize($this->minionInformation->getLevel());
        $this->money = $this->namedtag->getFloat('Money', 0);
        $invTag = $this->namedtag->getListTag('MinionInventory');
        if ($invTag !== null) {
            $this->minionInventory->setContents(array_map(function (CompoundTag $tag): Item {
                return Item::nbtDeserialize($tag);
            }, $invTag->getValue()));
        }
        $armor1 = Item::get(397, 3, 1);
        $color = new Color(192, 192, 192);
        $armor2 = Item::get(299, 0, 1);
        $armor2->setCustomColor($color);
        $armor3 = Item::get(300, 0, 1);
        $armor3->setCustomColor($color);
        $armor4 = Item::get(301, 0, 1);
        $armor4->setCustomColor($color);
        $this->getArmorInventory()->setHelmet($armor1);
        $this->getArmorInventory()->setChestplate($armor2);
        $this->getArmorInventory()->setLeggings($armor3);
        $this->getArmorInventory()->setBoots($armor4);
        $tool = BetterMinion::getInstance()->getConfig()->getNested('tool.tier', 'diamond');
        $isNetheriteTool = $tool === 'Netherite';
        $this->getInventory()->setItemInHand($this->getTool($tool, $isNetheriteTool));
        if ($this->isInventoryFull()) {
            $this->stopWorking();
            $this->currentAction = self::ACTION_CANT_WORK;
            $this->setNameTag("Inventory Full");
        } else {
            $this->setNameTag($this->getMinionInformation()->getType()->getTargetName(). " Minion");
        }
    }

    protected function getSmeltedTarget(): ?Item
    {
        $smeltedItems = json_decode(file_get_contents(BetterMinion::getInstance()->getDataFolder() . 'smelts.json'), true);
        foreach ($smeltedItems as $input => $output) {
            $realInput = Item::fromString($input, false);
            $realOutput = Item::fromString($output, false);
            foreach ($this->getRealDrops() as $drop) {
                if ($realInput->equals($drop, true)) {
                    return $realOutput;
                }
            }
        }

        return null;
    }

    protected function canUseAutoSmelter(): bool
    {
        return $this->getSmeltedTarget() !== null;
    }

    /**
     * @return null|Item|Item[]
     */
    protected function getCompactedTarget(): ?Item
    {
        $compactedItems = json_decode(file_get_contents(BetterMinion::getInstance()->getDataFolder() . 'compacts.json'), true);
        foreach ($compactedItems as $input => $output) {
            $realInput = Item::fromString($input, false);
            $realOutput = Item::fromString($output, false);
            foreach ($this->getRealDrops() as $drop) {
                if ($realInput->equals($drop, true)) {
                    return $realOutput;
                }
            }
        }

        return null;
    }

    protected function canUseCompacter(): bool
    {
        return $this->getCompactedTarget() !== null;
    }

    protected function canUseExpander(): bool
    {
        return true;
    }

    protected function isWorkFast(): bool
    {
        return false;
    }

    protected function getTargetDrops(): array
    {
        $drops = $this->getRealDrops();
        if ($this->getMinionInformation()->getUpgrade()->isAutoSmelt()) {
            $drops = [$this->getSmeltedTarget()];
        }
    if ($this->getMinionInformation()->getUpgrade()->isCompact()) {

            $drops = [$this->getCompactedTarget()];

          }
        
        return $drops;
    }

    protected function updateTarget(): void
    {
    }

    abstract protected function getTarget();

    protected function checkTarget(): bool
    {
        return $this->target->getId() === BlockIds::AIR || ($this->target->getId() === $this->getMinionInformation()->getType()->getTargetId() && $this->target->getDamage() === $this->getMinionInformation()->getType()->getTargetMeta());
    }

    protected function stopWorking(): void
    {
        $this->currentAction = self::ACTION_IDLE;
        $this->currentActionTicks = 0;
        $this->target = null;
    }

    protected function isInventoryFull(): bool
    {
        $full = true;
        $drops = $this->getTargetDrops();
        if ($this->getMinionInformation()->getUpgrade()->isCompact()) {
            $drop[] = $this->getCompactedTarget()->setCount(1);
        }
        foreach ($drops as $item) {
            if ($this->getMinionInventory()->canAddItem($item->setCount(1))) {
                $full = false;
            }
        }

        return $full;
    }

    abstract protected function getTool(string $tool, bool $isNetheriteTool): Item;

    protected function getMinionRange(): int
    {
        return $this->getMinionInformation()->getUpgrade()->isExpand() ? 3 : 2;
    }

    protected function startWorking(): void
    {
        $this->level->addParticle(new DestroyBlockParticle($this->target->add(0.5, 0.5, 0.5), $this->target));
        $this->level->setBlock($this->target, $this->target->getId() === BlockIds::AIR ? $this->getMinionInformation()->getType()->toBlock() : Block::get(BlockIds::AIR));
        if ($this->target->getId() !== BlockIds::AIR) {
            $drops = $this->getTargetDrops();
            foreach ($drops as $drop) {
                for ($i = 1; $i <= $drop->getCount(); ++$i) {
                    $thing = Item::get($drop->getId(), $drop->getDamage());
                    if ($this->getMinionInventory()->canAddItem($thing)) {
                        $this->getMinionInventory()->addItem($thing);
                        $this->getMinionInformation()->incrementResourcesCollected();
                    }
                }
            }
        }
    }

    private function checkFull(): bool
    {
        if ($this->isInventoryFull()) {
            if ($this->getMinionInformation()->getUpgrade()->isAutoSell()) {
                $this->sellItems();
            }
            $this->currentAction = self::ACTION_CANT_WORK;
            $this->setNameTag("Inventory Full");

            return false;
        }

        return true;
    }

    private function getRealDrops(): array
    {
        $block = $this->getMinionInformation()->getType()->toBlock();
        $drops = $block->getDropsForCompatibleTool(Item::get(BlockIds::AIR));
        if (empty($drops)) {
            $drops = $block->getSilkTouchDrops(Item::get(BlockIds::AIR));
        }

        return $drops;
    }

    private function destroy(): void
    {
        if ($this->target instanceof Block) {
            $this->level->broadcastLevelEvent($this->target, LevelEventPacket::EVENT_BLOCK_STOP_BREAK);
        }
        $this->minionInventory->dropContents($this->level, $this);
        $minionItem = Item::fromString((string) BetterMinion::getInstance()->getConfig()->get('minion-item'), false);
        $minionItem->setCustomName(TextFormat::RESET . TextFormat::YELLOW . $this->getMinionInformation()->getType()->getTargetName() . ' Minion ' . Utils::getRomanNumeral($this->getMinionInformation()->getLevel()));
        $minionItem->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
        $minionItem->setNamedTagEntry($this->minionInformation->nbtSerialize());
        $this->level->dropItem($this, $minionItem);
        $this->flagForDespawn();
    }

    private function sellItems(): void
    {
        $sellAll = BetterMinion::getInstance()->getServer()->getPluginManager()->getPlugin('SellAll');
        $sellPrices = $sellAll->getConfig()->getAll();
        $item = $this->getMinionInventory()->getItem($this->getMinionInventory()->getSize() - 1);
        if (isset($sellPrices[$item->getId()])) {
            $this->money += $sellPrices[$item->getId()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        } elseif (isset($sellPrices[$item->getId() . ':' . $item->getDamage()])) {
            $this->money += $sellPrices[$item->getId() . ':' . $item->getDamage()] * $item->getCount();
            $this->getMinionInventory()->remove($item);
        }
    }
    
    public function hello($player) {
    $menu = InvMenu::create(InvMenu::TYPE_CHEST);
    $menu->readonly();
    $menu->setName("§l§6UPGRADE RECIPES");
    $inventory = $menu->getInventory();
      $inventory->setItem(0, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(1, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(2, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(3, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(4, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(5, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(6, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(7, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(8, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(9, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(10, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(11, Item::get(11, 0, 1)->setCustomName("§r§l§eSUPER LAVA\n\n§r§bClick To View Super Lava Recipes\n§r§bFor Enable Compacter And Auto\n§r§bSmelter.\n\n§r§l§dClick To View"));
	    $inventory->setItem(12, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(13, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(14, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(15, Item::get(9, 0, 1)->setCustomName("§r§l§eSUPER WATER\n\n§r§bClick To View Super Water Recipes\n§r§bFor Upgrade Minion To Next Level.\n\n§r§l§dClick To View"));
	    $inventory->setItem(16, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(17, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(18, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(19, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(20, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(21, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(22, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(23, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(24, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(25, Item::get(160, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(26, Item::get(160, 15, 1)->setCustomName("§r"));
	    $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {
                        $player = $transaction->getPlayer();
                        $itemClicked = $transaction->getItemClicked();
                        $action = $transaction->getAction();
            switch ($action->getSlot()) {

        case 11:
                    
  $this->superlava($player);
                    
         break;
                    
        case 15:
                    
  $this->superwater($player);
                    
         break;
                    }
                    }));
                    $menu->send($player);
                    }

public function superlava($player) {
    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->readonly();
    $menu->setName("§l§6SUPER LAVA");
    $inventory = $menu->getInventory();
    $inventory->setItem(0, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(1, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(2, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(3, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(4, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(5, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(6, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(7, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(8, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(9, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(10, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(11, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(12, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(13, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(14, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(15, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(16, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(17, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(18, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(19, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(24, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(20, Item::get(264, 0, 10));
	    $inventory->setItem(21, Item::get(264, 0, 10));
	    $inventory->setItem(22, Item::get(264, 0, 10));
	    $inventory->setItem(23, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(25, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(26, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(27, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(28, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(29, Item::get(264, 0, 10));
	    $inventory->setItem(30, Item::get(437, 0, 5));
	    $inventory->setItem(31, Item::get(264, 0, 10));
	    $inventory->setItem(32, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(33, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(34, Item::get(11, 0, 1)->setCustomName("§r§l§eSUPER LAVA")->setLore(["§r§bUse This For Enable Compacter\n§r§bAnd Auto Smelter\n§r§l§aUNCOMMON"]));
	    $inventory->setItem(35, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(36, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(37, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(38, Item::get(264, 0, 10));
	    $inventory->setItem(39, Item::get(264, 0, 10));
	    $inventory->setItem(40, Item::get(264, 0, 10));
	    $inventory->setItem(41, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(42, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(43, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(44, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(45, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(46, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(47, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(48, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(49, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(50, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(51, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(52, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(53, Item::get(95, 15, 1)->setCustomName("§r"));
	         $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {
                        $player = $transaction->getPlayer();
                        $itemClicked = $transaction->getItemClicked();
                        $action = $transaction->getAction();
                 
                 switch ($action->getSlot()) {
                         }
                 }));
      $menu->send($player);
                    }
	
public function superwater($player) {
    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->readonly();
    $menu->setName("§l§6SUPER WATER");
    $inventory = $menu->getInventory();
    $inventory->setItem(0, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(1, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(2, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(3, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(4, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(5, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(6, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(7, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(8, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(9, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(10, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(11, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(12, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(13, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(14, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(15, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(16, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(17, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(18, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(19, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(23, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(21, Item::get(264, 0, 10));
	    $inventory->setItem(22, Item::get(264, 0, 10));
	    $inventory->setItem(20, Item::get(264, 0, 10));
	    $inventory->setItem(24, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(25, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(26, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(27, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(28, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(29, Item::get(264, 0, 10));
	    $inventory->setItem(30, Item::get(399, 0, 5));
	    $inventory->setItem(31, Item::get(264, 0, 10));
	    $inventory->setItem(32, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(33, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(34, Item::get(9, 0, 1)->setCustomName("§r§l§eSUPER WATER")->setLore(["§r§bUse This For Upgrade Minion\n§r§bTo Next Level\n§r§l§7COMMON"]));
	    $inventory->setItem(35, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(36, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(37, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(38, Item::get(264, 0, 10));
	    $inventory->setItem(39, Item::get(264, 0, 10));
	    $inventory->setItem(40, Item::get(264, 0, 10));
	    $inventory->setItem(41, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(42, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(43, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(44, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(45, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(46, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(47, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(48, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(49, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(50, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(51, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(52, Item::get(95, 15, 1)->setCustomName("§r"));
	    $inventory->setItem(53, Item::get(95, 15, 1)->setCustomName("§r"));
	         $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {
                        $player = $transaction->getPlayer();
                        $itemClicked = $transaction->getItemClicked();
                        $action = $transaction->getAction();
                  
                 switch ($action->getSlot()) {
                         }
                 }));
      $menu->send($player);
                 }
              

    private function getLevelUpCost(): int
    {
        $costs = (array) BetterMinion::getInstance()->getConfig()->get('levelup-costs');

        return (int) $costs[$this->getMinionInformation()->getLevel()];
    }

    private function getAutoSmeltCost(): int
    {
        return (int) BetterMinion::getInstance()->getConfig()->get('autosmelt');
    }

    private function getAutoSellCost(): int
    {
        return (int) BetterMinion::getInstance()->getConfig()->get('autosell');
    }

    private function getCompactCost(): int
    {
        return (int) BetterMinion::getInstance()->getConfig()->get('compact');
    }

    private function getExpandCost(): int
    {
        return (int) BetterMinion::getInstance()->getConfig()->get('expand');
    }
}