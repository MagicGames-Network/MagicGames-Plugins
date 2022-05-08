<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants;

use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\item\Armor;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use pocketmine\item\VanillaItems;
use pocketmine\inventory\Inventory;
use pocketmine\inventory\ArmorInventory;
use pocketmine\inventory\PlayerInventory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\event\entity\EntityEffectAddEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use DaPigGuy\PiggyCustomEnchants\entities\PiggyTNT;
use pocketmine\event\entity\EntityBlockChangeEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\inventory\CallbackInventoryListener;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use pocketmine\network\mcpe\protocol\MobEquipmentPacket;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\network\mcpe\protocol\types\PlayerAction;
use DaPigGuy\PiggyCustomEnchants\entities\BombardmentTNT;
use DaPigGuy\PiggyCustomEnchants\utils\ProjectileTracker;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\network\mcpe\protocol\InventorySlotPacket;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\InventoryContentPacket;
use DaPigGuy\PiggyCustomEnchants\enchants\TickingEnchantment;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\DrillerEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ToggleableEnchantment;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\network\mcpe\protocol\types\PlayerBlockActionWithBlockInfo;

class EventListener implements Listener
{
    private array $lastActivateTime = [];

    public function __construct(private PiggyCustomEnchants $plugin)
    {
    }

    /**
     * @priority HIGHEST
     */
    public function onBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        ReactiveEnchantment::attemptReaction($player, $event);
    }

    public function onDataPacketReceive(DataPacketReceiveEvent $event): void
    {
        $packet = $event->getPacket();
        if ($packet instanceof InventoryTransactionPacket) {
            $transaction = $packet->trData;
            foreach ($transaction->getActions() as $action) {
                $action->oldItem = new ItemStackWrapper($action->oldItem->getStackId(), Utils::filterDisplayedEnchants($action->oldItem->getItemStack()));
                $action->newItem = new ItemStackWrapper($action->newItem->getStackId(), Utils::filterDisplayedEnchants($action->newItem->getItemStack()));
            }
        }
        if ($packet instanceof PlayerActionPacket) {
            if ($packet->action === PlayerAction::START_BREAK || $packet->action === PlayerAction::CREATIVE_PLAYER_DESTROY_BLOCK) {
                DrillerEnchant::$lastBreakFace[$event->getOrigin()->getPlayer()->getName()] = $packet->face;
            }
        }
        if ($packet instanceof PlayerAuthInputPacket) {
            $blockActions = $packet->getBlockActions();
            if ($blockActions !== null) {
                foreach ($blockActions as $blockAction) {
                    if ($blockAction instanceof PlayerBlockActionWithBlockInfo) {
                        DrillerEnchant::$lastBreakFace[$event->getOrigin()->getPlayer()->getName()] = $blockAction->getFace();
                    }
                }
            }
        }
        if ($packet instanceof MobEquipmentPacket) Utils::filterDisplayedEnchants($packet->item->getItemStack());
    }

    public function onDataPacketSend(DataPacketSendEvent $event): void
    {
        $packets = $event->getPackets();
        foreach ($packets as $packet) {
            if ($packet instanceof InventorySlotPacket) {
                $packet->item = new ItemStackWrapper($packet->item->getStackId(), Utils::displayEnchants($packet->item->getItemStack()));
            }
            if ($packet instanceof InventoryContentPacket) {
                foreach ($packet->items as $i => $item) {
                    $packet->items[$i] = new ItemStackWrapper($item->getStackId(), Utils::displayEnchants($item->getItemStack()));
                }
            }
        }
    }

    public function onBlockChange(EntityBlockChangeEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof BombardmentTNT) {
            for ($i = 0; $i < 3 + $entity->getEnchantmentLevel(); $i++) {
                $tnt = new PiggyTNT($entity->getLocation(), null, $this->plugin->getConfig()->getNested("world-damage.missile", false));
                $tnt->setFuse(0);
                $tnt->setOwningEntity($entity->getOwningEntity());
                $tnt->spawnToAll();
            }
            $event->cancel();
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_FALL && !Utils::shouldTakeFallDamage($entity)) {
                if ($entity->getArmorInventory()->getBoots()->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SPRINGS)) === null) Utils::setShouldTakeFallDamage($entity, true);
                $event->cancel();
                return;
            }
            ReactiveEnchantment::attemptReaction($entity, $event);
        }
        if ($event instanceof EntityDamageByEntityEvent) {
            $attacker = $event->getDamager();
            if ($attacker instanceof Player) ReactiveEnchantment::attemptReaction($attacker, $event);
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onEffectAdd(EntityEffectAddEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) ReactiveEnchantment::attemptReaction($entity, $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onShootBow(EntityShootBowEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) ReactiveEnchantment::attemptReaction($entity, $event);
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        if (!isset($this->lastActivateTime[$player->getUniqueId()->toString()]) || $this->lastActivateTime[$player->getUniqueId()->toString()] + 3 < time()) {
            ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
            $this->lastActivateTime[$player->getUniqueId()->toString()] = time();
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onItemHold(PlayerItemHeldEvent $event): void
    {
        $player = $event->getPlayer();
        $inventory = $player->getInventory();
        $oldItem = $inventory->getItemInHand();
        $newItem = $event->getItem();
        foreach ($oldItem->getEnchantments() as $enchantmentInstance) ToggleableEnchantment::attemptToggle($player, $oldItem, $enchantmentInstance, $inventory, $inventory->getHeldItemIndex(), false);
        foreach ($newItem->getEnchantments() as $enchantmentInstance) ToggleableEnchantment::attemptToggle($player, $newItem, $enchantmentInstance, $inventory, $inventory->getHeldItemIndex());
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        foreach ($player->getInventory()->getContents() as $slot => $content) {
            foreach ($content->getEnchantments() as $enchantmentInstance) {
                ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getInventory(), $slot);
            }
        }
        foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
            foreach ($content->getEnchantments() as $enchantmentInstance) {
                ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getArmorInventory(), $slot);
            }
        }

        $onSlot = function (Inventory $inventory, int $slot, Item $oldItem): void {
            if ($inventory instanceof PlayerInventory || $inventory instanceof ArmorInventory) {
                $holder = $inventory->getHolder();
                if ($holder instanceof Player) {
                    if (!$oldItem->equals(($newItem = $inventory->getItem($slot)), !$inventory instanceof ArmorInventory)) {
                        if ($newItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($oldItem->getEnchantments() as $oldEnchantment) ToggleableEnchantment::attemptToggle($holder, $oldItem, $oldEnchantment, $inventory, $slot, false);
                        if ($oldItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($newItem->getEnchantments() as $newEnchantment) ToggleableEnchantment::attemptToggle($holder, $newItem, $newEnchantment, $inventory, $slot);
                    }
                }
            }
        };
        /**
         * @param Item[] $oldContents
         */
        $onContent = function (Inventory $inventory, array $oldContents) use ($onSlot): void {
            foreach ($oldContents as $slot => $oldItem) {
                if (!($oldItem ?? VanillaItems::AIR())->equals($inventory->getItem($slot), !$inventory instanceof ArmorInventory)) {
                    $onSlot($inventory, $slot, $oldItem);
                }
            }
        };
        $player->getInventory()->getListeners()->add(new CallbackInventoryListener($onSlot, $onContent));
        $player->getArmorInventory()->getListeners()->add(new CallbackInventoryListener($onSlot, $onContent));
    }

    /**
     * @priority HIGHEST
     */
    public function onMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();

        if (!isset($this->lastActivateTime[$player->getUniqueId()->toString()]) || $this->lastActivateTime[$player->getUniqueId()->toString()] + 5 < time()) {
            /*if (!Utils::shouldTakeFallDamage($player)) {
                if (Utils::getNoFallDamageDuration($player) <= 0) {
                    Utils::setShouldTakeFallDamage($player, true);
                } else {
                    Utils::increaseNoFallDamageDuration($player);
                }
            }*/
            if (!$event->getFrom()->floor()->equals($event->getTo()->floor())) {
                ReactiveEnchantment::attemptReaction($player, $event);
            }

            $currentTick = Server::getInstance()->getTick();
            $successfulEnchantments = [];
            foreach ($player->getInventory()->getContents() as $slot => $content) {
                if ($content->getId() === ItemIds::BOOK) {
                    if (count($content->getEnchantments()) > 0) {
                        $enchantedBook = ItemFactory::getInstance()->get(ItemIds::ENCHANTED_BOOK, 0, $content->getCount(), $content->getNamedTag());
                        $enchantedBook->setCustomName(TextFormat::RESET . TextFormat::YELLOW . "Enchanted Book" . TextFormat::RESET);
                        $enchantedBook->addEnchantment(...$content->getEnchantments());
                        $player->getInventory()->setItem($slot, $enchantedBook);
                        continue;
                    }
                } elseif ($content instanceof Tool) {
                    if ($content->getNamedTag()->getTag("PiggyCEItemVersion") === null && count($content->getEnchantments()) > 0) $player->getInventory()->setItem($slot, Utils::cleanOldItems($content));
                    foreach ($content->getEnchantments() as $enchantmentInstance) {
                        /** @var TickingEnchantment $enchantment */
                        $enchantment = $enchantmentInstance->getType();
                        if ($enchantment instanceof CustomEnchant && $enchantment->canTick()) {
                            if (!in_array($enchantment, $successfulEnchantments, true) || $enchantment->supportsMultipleItems()) {
                                if (($enchantment->getUsageType() === CustomEnchant::TYPE_ANY_INVENTORY ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_INVENTORY ||
                                    ($enchantment->getUsageType() === CustomEnchant::TYPE_HAND && $slot === $player->getInventory()->getHeldItemIndex())
                                )) {
                                    if ($currentTick % $enchantment->getTickingInterval() === 0) {
                                        $enchantment->onTick($player, $content, $player->getInventory(), $slot, $enchantmentInstance->getLevel());
                                        $successfulEnchantments[] = $enchantment;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
                if ($content instanceof Armor) {
                    if ($content->getNamedTag()->getTag("PiggyCEItemVersion") === null && count($content->getEnchantments()) > 0) $player->getArmorInventory()->setItem($slot, Utils::cleanOldItems($content));
                    foreach ($content->getEnchantments() as $enchantmentInstance) {
                        /** @var TickingEnchantment $enchantment */
                        $enchantment = $enchantmentInstance->getType();
                        if ($enchantment instanceof CustomEnchant && $enchantment->canTick()) {
                            if (!in_array($enchantment, $successfulEnchantments, true) || $enchantment->supportsMultipleItems()) {
                                if (($enchantment->getUsageType() === CustomEnchant::TYPE_ANY_INVENTORY ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_ARMOR_INVENTORY ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_HELMET && Utils::isHelmet($content) ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_CHESTPLATE && Utils::isChestplate($content) ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_LEGGINGS && Utils::isLeggings($content) ||
                                    $enchantment->getUsageType() === CustomEnchant::TYPE_BOOTS && Utils::isBoots($content)
                                )) {
                                    if ($currentTick % $enchantment->getTickingInterval() === 0) {
                                        $enchantment->onTick($player, $content, $player->getArmorInventory(), $slot, $enchantmentInstance->getLevel());
                                        $successfulEnchantments[] = $enchantment;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $this->lastActivateTime[$player->getUniqueId()->toString()] = time();
        }
    }

    /**
     * @priority MONITOR
     */
    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();

        if (isset($this->lastActivateTime[$player->getUniqueId()->toString()])) {
            unset($this->lastActivateTime[$player->getUniqueId()->toString()]);
        }
        if (!$player->isClosed()) {
            foreach ($player->getInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getInventory(), $slot, false);
                }
            }
            foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getArmorInventory(), $slot, false);
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onSneak(PlayerToggleSneakEvent $event): void
    {
        ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onProjectileHitBlock(ProjectileHitBlockEvent $event): void
    {
        $shooter = $event->getEntity()->getOwningEntity();
        if ($shooter instanceof Player) ReactiveEnchantment::attemptReaction($shooter, $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onProjectileLaunch(ProjectileLaunchEvent $event): void
    {
        $projectile = $event->getEntity();
        $shooter = $projectile->getOwningEntity();
        if ($shooter instanceof Player) ProjectileTracker::addProjectile($projectile, $shooter->getInventory()->getItemInHand());
    }

    /**
     * @priority HIGHEST
     */
    public function onTransaction(InventoryTransactionEvent $event): void
    {
        if ($this->plugin->getConfig()->getNested("enchants.books", true) === false) return;
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::ENCHANTED_BOOK && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR && ($itemClicked->getId() !== ItemIds::ENCHANTED_BOOK || count($itemClicked->getEnchantments()) >= count($itemClickedWith->getEnchantments()))) {
                    if (count($itemClickedWith->getEnchantments()) < 1) return;
                    $enchantmentSuccessful = false;
                    foreach ($itemClickedWith->getEnchantments() as $enchantment) {
                        $enchantmentType = $enchantment->getType();
                        $newLevel = $enchantment->getLevel();
                        $willChange = false;
                        if (($existingEnchant = $itemClicked->getEnchantment($enchantmentType)) !== null) {
                            if ($existingEnchant->getLevel() > $newLevel) continue;
                            if ($existingEnchant->getLevel() === $newLevel) {
                                $newLevel++;
                                $willChange = true;
                            }
                        } else {
                            $willChange = true;
                        }
                        if (
                            ($enchantmentType instanceof CustomEnchant &&
                                (!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType))
                            ) ||
                            $itemClicked->getCount() !== 1 ||
                            $newLevel > $enchantmentType->getMaxLevel() ||
                            ($itemClicked->getId() === ItemIds::ENCHANTED_BOOK && count($itemClicked->getEnchantments()) === 0) ||
                            $itemClicked->getId() === ItemIds::BOOK
                        ) continue;
                        $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                        if ($willChange) $enchantmentSuccessful = true;
                    }
                    if ($enchantmentSuccessful) {
                        $event->cancel();
                        $action->getInventory()->setItem($action->getSlot(), $itemClicked);
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                    }
                }
            }
        }
    }
}
