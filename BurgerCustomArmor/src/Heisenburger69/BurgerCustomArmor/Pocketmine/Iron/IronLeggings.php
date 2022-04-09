<?php

namespace Heisenburger69\BurgerCustomArmor\Pocketmine\Iron;

use pocketmine\item\Armor;
use pocketmine\item\ItemIds;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;
use pocketmine\inventory\ArmorInventory;
use Heisenburger69\BurgerCustomArmor\Main;
use Heisenburger69\BurgerCustomArmor\ArmorSets\CustomArmorSet;

class IronLeggings extends Armor
{
    /** @var float */
    protected $metaFloat = 0.0;

    public function __construct(int $meta = 0)
    {
        parent::__construct(new ItemIdentifier(ItemIds::IRON_LEGGINGS, $meta), "Iron Leggings", new ArmorTypeInfo(5, 226, ArmorInventory::SLOT_LEGS));
    }

    public function getMaxDurability(): int
    {
        if (($nbt = $this->getNamedTag()->getTag("burgercustomarmor")) !== null) {
            $setName = $nbt->getValue();
            $armorSet = Main::$instance->customSets[$setName];
            if ($armorSet instanceof CustomArmorSet) {
                return isset($armorSet->durabilities["chestplate"]) ? $armorSet->durabilities["chestplate"] : parent::getMaxDurability();
            }
        }
        return parent::getMaxDurability();
    }

    public function applyDamage(int $amount): bool
    {
        if ($this->isUnbreakable() or $this->isBroken()) {
            return false;
        }

        $amount -= $this->getUnbreakingDamageReduction($amount);
        $factor = $this->getMaxDurability() / parent::getMaxDurability();
        $this->metaFloat = ($this->metaFloat + ($amount / $factor));
        $this->meta = min((int)round($this->metaFloat), parent::getMaxDurability());
        if ($this->isBroken()) {
            $this->onBroken();
        }

        return true;
    }
}