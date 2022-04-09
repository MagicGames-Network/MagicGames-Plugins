<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\Server;

class ItemsForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§6ENCHANTED BLOCKS","§dTake Admins Item",
        [
            new MenuOption("§5Enchanted Coal", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Iron", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Gold", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Lapis", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Redstone", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Diamond", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Emerald", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Nether Quartz", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Coal Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Iron Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Gold Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Lapis Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Redstone Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Diamond Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Emerald Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Quartz Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Cobblestone", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Netherack Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Endstone Block", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Carrot", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Potato", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Wheat", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Melon", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Pumpkin", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Dirt", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Sand", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED OAK LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_oak",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED ACACIA LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_acacia",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED BIRCH LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_birch",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED SPRUCE LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_spruce",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED JUNGLE LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_jungle",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eENCHANTED DARK OAK LOG\n§9»» §r§6Tap To View", new FormIcon("textures/blocks/log_big_oak",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Snow", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Steak", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Chicken", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§5Enchanted Mutton", new FormIcon("textures/icon/enchant",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eGOD SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/gold_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eEND SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eGOLEM SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/iron_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eRABBIT SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/stone_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eTELEKANISES SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSMELT SWORD\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_sword",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eTELEKANISES PICKAXE\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_pickaxe",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSMELT PICKAXE\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_pickaxe",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eTELEKANISES AXE\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_axe",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSMELT AXE\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_axe",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eTELEKANISES SHOVEL\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_shovel",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSMELT SHOVEL\n§9»» §r§6Tap To Get", new FormIcon("textures/items/diamond_shovel",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eGRAPLING HOOK\n§9»» §r§6Tap To Get", new FormIcon("textures/items/fishing_rod_uncast",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eHAMMER\n§9»» §r§6Tap To Get", new FormIcon("textures/items/iron_pickaxe",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eRUNNAN'S BOW\n§9»» §r§6Tap To Get", new FormIcon("textures/items/bow_pulling_2",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSUPER SMELTER\n§9»» §r§6Tap To Get", new FormIcon("textures/blocks/furnace_front_off",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSUPER COMPACTER\n§9»» §r§6Tap To Get", new FormIcon("textures/blocks/dispenser_front_horizontal",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§eSUPER EXPANDER\n§9»» §r§6Tap To Get", new FormIcon("textures/blocks/command_block",FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§aBACK\n§9»» §r§bTap To Go Back", new FormIcon("textures/ui/icon_import",FormIcon::IMAGE_TYPE_PATH))
        ], function (Player $sender, int $selected): void {
                switch($selected) {
                case 0:
                $item = ItemFactory::getInstance()->get(263,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Coal\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                    
                case 1:
                $item = ItemFactory::getInstance()->get(265,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Iron\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 2:
                $item = ItemFactory::getInstance()->get(266,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Gold\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 3:
                $item = ItemFactory::getInstance()->get(351,4,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Lapis\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 4:
                $item = ItemFactory::getInstance()->get(331,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Redstone\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 5:
                $item = ItemFactory::getInstance()->get(264,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Diamond\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 6:
                $item = ItemFactory::getInstance()->get(388,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Emerald\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 7:
                $item = ItemFactory::getInstance()->get(406,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Quartz\n§7Use It To Craft Minion And Custom Armor\n\n§l§9RARE");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 8:
                $item = ItemFactory::getInstance()->get(173,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Coal Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 9:
                $item = ItemFactory::getInstance()->get(42,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Iron Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 10:
                $item = ItemFactory::getInstance()->get(41,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Gold Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 11:
                $item = ItemFactory::getInstance()->get(22,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Lapis Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 12:
                $item = ItemFactory::getInstance()->get(152,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Redstone Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 13:
                $item = ItemFactory::getInstance()->get(57,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Diamond Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 14:
                $item = ItemFactory::getInstance()->get(133,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Emerald Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 15:
                $item = ItemFactory::getInstance()->get(155,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Quartz Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 16:
                $item = ItemFactory::getInstance()->get(4,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Cobblestone\n§7Use It To Craft Minion And Custom Armor\n\n§d§lUNCOMMON");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 17:
                $item = ItemFactory::getInstance()->get(87,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Netherack\n§7Use It To Craft Minion And Custom Armor\n\n§9§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 18:
                $item = ItemFactory::getInstance()->get(121,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted End Stone\n§7Use It To Craft Minion And Custom Armor\n\n§9§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 19:
                $item = ItemFactory::getInstance()->get(391,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Carrot\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 20:
                $item = ItemFactory::getInstance()->get(392,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Potato\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 21:
                $item = ItemFactory::getInstance()->get(296,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Wheat\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 22:
                $item = ItemFactory::getInstance()->get(103,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Melon\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 23:
                $item = ItemFactory::getInstance()->get(86,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Pumpkin\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 24:
                $item = ItemFactory::getInstance()->get(3,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Dirt Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 25:
                $item = ItemFactory::getInstance()->get(12,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Sand Block\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 26:
                $item = ItemFactory::getInstance()->get(17,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Qak Logs\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 27:
                $item = ItemFactory::getInstance()->get(162,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Acacia Log\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 28:
                $item = ItemFactory::getInstance()->get(17,1,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Spruce Log\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 29:
                $item = ItemFactory::getInstance()->get(17,2,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Birch Log\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                 case 30:
                $item = ItemFactory::getInstance()->get(17,3,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Jungle Log\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 31:
                $item = ItemFactory::getInstance()->get(162,1,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Dark Oak Log\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                                
                case 32:
                $item = ItemFactory::getInstance()->get(80,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Snow\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 33:
                $item = ItemFactory::getInstance()->get(363,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Steak\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 34:
                $item = ItemFactory::getInstance()->get(365,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Chicken\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 35:
                $item = ItemFactory::getInstance()->get(423,0,64);
                $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId("-1")));
                $item->setCustomName("§r§eEnchanted Mutton\n§7Use It To Craft Minion And Custom Armor\n\n§d§lEPIC");
                $inv = $sender->getInventory();
                $inv->addItem($item);
                break;
                
                case 36:
                if(!$sender->hasPermission("tool.godsword")) return;
      								$tool = ItemFactory::get(Item::GOLD_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6GOD SWORD§r");
      						 	 $tool->setLore(["§r§7Damage: §c200+\n§r§7Strength: §c100+\n\n§r§l§6•Item Ability: THUNDER §d[§r§l§eRIGHT CLICK§d]\n§r§b•Right Click To Lighting In\n§r§b•Clicked Block Like A God.\n\n§r§l§eLEGENDARY"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 37:
                if(!$sender->hasPermission("tool.endsword")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6END SWORD§r");
      								$tool->setLore(["§r§7Damage: §c150+\n§r§7Strength: §c75+\n\n§r§l§6•Item Ability: TELEPORTING §d[§r§l§eRIGHT CLICK§d]\n§r§b•Right Click To Teleport In\n§r§b•Clicked Block Like A Enderman.\n\n§r§l§9RARE"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 38:
                if(!$sender->hasPermission("tool.golemsword")) return;
      								$tool = ItemFactory::get(Item::IRON_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6GOLEM SWORD§r");
      								$tool->setLore(["§r§7Damage: §c100+\n§r§7Strength: §c50+\n\n§r§l§6•Item Ability: EXPLOSION §d[§r§l§eRIGHT CLICK§d]\n§r§b•Right Click To Explosion In\n§r§b•Clicked Block Like A TNT.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 39:
                if(!$sender->hasPermission("tool.rabbitsword")) return;
      								$tool = ItemFactory::get(Item::STONE_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6RABBIT SWORD§r");
      								$tool->setLore(["§r§7Damage: §c50+\n§r§7Strength: §c25+\n\n§r§l§6•Item Ability: JUMP BOOST §d[§r§l§eRIGHT CLICK§d]\n§r§b•Right Click To Get Jump Boost\n§r§b•Like A Rabbit.\n\n§r§l§7COMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 40:
                if(!$sender->hasPermission("tool.telekanisessword")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6TELEKANISES SWORD§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO PICKUP §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Kill Any Mobs So This\n§r§bAutomatically Come In You Inventory.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 41:
                if(!$sender->hasPermission("tool.smeltsword")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_SWORD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6SMELT SWORD§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO SMELT §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Kill Any Mobs So This\n§r§bAutomatically Smelt And Cooked.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 42:
                if(!$sender->hasPermission("tool.telekanisespickaxe")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_PICKAXE);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6TELEKANISES PICKAXE§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO PICKUP §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Mine Any Block So This\n§r§bAutomatically Come In You Inventory.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 43:
                if(!$sender->hasPermission("tool.smeltpickaxe")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_PICKAXE);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6SMELT PICKAXE§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO SMELT §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Mine Any Block So This\n§r§bAutomatically Smelt In Items.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 44:
                if(!$sender->hasPermission("tool.telekanisesaxe")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_AXE);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6TELEKANISES AXE§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO PICKUP §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Chop Any Tree So This\n§r§bAutomatically Come In You Inventory.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 45:
                if(!$sender->hasPermission("tool.smeltaxe")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_AXE);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6SMELT AXE§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO SMELT §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Chop Any Tree So This\n§r§bAutomatically Smelt In Coal.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 46:
                if(!$sender->hasPermission("tool.telekanisesshovel")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_SHOVEL);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6TELEKANISES SHOVEL§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO PICKUP §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Dig Any Block So This\n§r§bAutomatically Come In You Inventory.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 47:
                if(!$sender->hasPermission("tool.smeltshovel")) return;
      								$tool = ItemFactory::get(Item::DIAMOND_SHOVEL);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6SMELT SHOVEL§r");
      								$tool->setLore(["§r§l§6Item Ability: AUTO SMELT §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Dig Any Block So This\n§r§bAutomatically Smelt In Items.\n\n§r§l§aUNCOMMON"]);;
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 48:
                if(!$sender->hasPermission("tool.graplinghook")) return;
      								$tool = ItemFactory::get(Item::FISHING_ROD);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6GRAPLING HOOK§r");
      								$tool->setLore(["§r§l§6•Item Ability: TRAVEL §d[§r§l§eLEFT CLICK§d]\n§r§b•If You Hold In Any Block So\n§r§b•You Travel That Position.\n\n§r§l§9RARE"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 49:
                if(!$sender->hasPermission("tool.hammer")) return;
      								$tool = ItemFactory::get(Item::IRON_PICKAXE);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6HAMMER§r");
      								$tool->setLore(["§r§l§6Item Ability: MINE 3x3 §d[§r§l§eLEFT CLICK§d]\n§r§bIf You Click In Any Block\n§r§bSo 3x3 Area Is Mined.\n\n§r§l§aUNCOMMON"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 50:
                if(!$sender->hasPermission("tool.runnanbow")) return;
      								$tool = ItemFactory::get(Item::BOW);
      								$tool->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
      								$tool->setCustomName("§r§l§6RUNNAN'S BOW§r");
      								$tool->setLore(["§r§7Damage: §c100+\n§r§7Strength: §c100+\n\n§r§l§6•Item Ability: POWERFULL ARROW §d[§r§l§eLEFT CLICK§d]\n§r§b•If You Hold And Shoot Arrow\n§r§b•So Arrow Give More Damage.\n\n§r§l§eLEGENDARY"]);
      								$sender->getInventory()->addItem($tool);
                break;
                
                case 51:
          if(!$sender->hasPermission("super.supersmelter")) return;
								$item = ItemFactory::getInstance()->get(61, 0, 1);
								$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
								$item->setCustomName("§r§l§eSUPER SMELTER§r§r\n\n§r§7Use This Super Smelter For Enable\n§r§7Auto Smelter Upgrade In Your Any Minion.");
								$item->setLore(["§r§l§eLEGENDARY"]);
								$sender->getInventory()->addItem($item);
          break;
          
          case 52:
          if(!$sender->hasPermission("super.supercompacter")) return;
								$item = ItemFactory::getInstance()->get(23, 0, 1);
								$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
								$item->setCustomName("§r§l§eSUPER COMPACTER§r§r\n\n§r§7Use This Super Compacter For Enable\n§r§7Compacter Upgrade In Your Any Minion.");
								$item->setLore(["§r§l§eLEGENDARY"]);
								$sender->getInventory()->addItem($item);
          break;
          
          case 53:
          if(!$sender->hasPermission("super.superexpander")) return;
								$item = ItemFactory::getInstance()->get(137, 0, 1);
								$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH));
								$item->setCustomName("§r§l§eSUPER EXPANDER§r§r\n\n§r§7Use This Super Expander For Enable\n§r§7Expander Upgrade In Your Any Minion.");
								$item->setLore(["§r§l§eLEGENDARY"]);
								$sender->getInventory()->addItem($item);
          break;
                }
            });
    }

}