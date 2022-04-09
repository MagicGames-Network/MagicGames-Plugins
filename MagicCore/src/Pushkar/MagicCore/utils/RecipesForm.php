<?php

namespace Pushkar\MagicCore\menu;

use pocketmine\Server;
use pocketmine\nbt\NBT;
use pocketmine\item\Item;
use muqsit\invmenu\InvMenu;
use Pushkar\MagicCore\Main;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\nbt\tag\ListTag;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\nbt\tag\CompoundTag;

class Recipe
{
	private Main $plugin;

	public function __construct(Main $plugin)
	{
		$this->plugin = $plugin;
	}

	public function cui($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->minions($sender);
					break;

				case 1:
					$this->armors($sender);
					break;

				case 2:
					$this->items($sender);
					break;

				case 3:
					$this->eblocks($sender);
					break;

				case 4:
					$sender->sendTitle("§r§l§eCOMMING SOON");
					break;

				case 5:
					$this->ore($sender);
					break;

				case 6:
					Server::getInstance()->dispatchCommand($sender, "customtable");
					break;

				case 7:
					$this->helpme($sender);
					break;

				case 8:
					break;
			}
		});
		$form->setTitle("§l§6RECIPES BOOK");
		$form->setContent("§bUse Only Custom Crafting Table To Craft Things, Do /customtable\n§dSelect The Recipe You Want:", 0,);
		$form->addButton("§l§eMINION RECIPES\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eCUSTOM ARMOR RECIPES\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/361/361761.png");
		$form->addButton("§l§eCUSTOM ITEMS RECIPES\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/487/487551.png");
		$form->addButton("§l§eENCHANTED ITEMS\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/3556/3556661.png");
		$form->addButton("§l§eTALISMAN\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/1625/1625674.png");
		$form->addButton("§l§eORE GENERATOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/4831/4831062.png");
		$form->addButton("§l§eCUSTOM CRAFTING TABLE\n§9»» §r§6Tap To Open", 0, "textures/blocks/crafting_table_top");
		$form->addButton("§l§dHELP\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/2476/2476231.png");
		$form->addButton("§l§cClose\n§9»» §r§cTap To Close", 0, "textures/ui/redX1");
		$sender->sendForm($form);
		return $form;
	}

	public function helpme($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->cui($sender);
					break;
			}
		});
		$name = $sender->getName();
		$form->setTitle("§l§6RECIPES HELP");
		$form->setContent("§bHi,§e $name \n\n§l§a» §6VIDEO MODE:§r §eFirst Go To Settings > Video > UI Profile > Classic§r\n\n§l§a» §6COMMAND:§r §eDo /customtable To Open Custom Table§r\n\n§l§a» §6ERROR:§r §eIf You Are Unable To Open Recipe Join Discord And See Recipe Channel", 0,);
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}
	
	public function minions($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->minion1($sender);
					break;

				case 1:
					$this->minion2($sender);
					break;

				case 2:
					$this->minion3($sender);
					break;

				case 3:
					$this->minion4($sender);
					break;

				case 4:
					$this->minion5($sender);
					break;

				case 5:
					$this->minion6($sender);
					break;

				case 6:
					$this->minion7($sender);
					break;

				case 7:
					$this->minion8($sender);
					break;

				case 8:
					$this->minion9($sender);
					break;

				case 9:
					$this->minion10($sender);
					break;

				case 10:
					$this->minion11($sender);
					break;

				case 11:
					$this->minion12($sender);
					break;

				case 12:
					$this->minion13($sender);
					break;

				case 13:
					$this->minion14($sender);
					break;

				case 14:
					$this->minion15($sender);
					break;

				case 15:
					$this->minion16($sender);
					break;

				case 16:
					$this->minion17($sender);
					break;

				case 17:
					$this->minion18($sender);
					break;

				case 18:
					$this->minion19($sender);
					break;

				case 19:
					$this->minion20($sender);
					break;

				case 20:
					$this->minion21($sender);
					break;

				case 21:
					$this->minion22($sender);
					break;

				case 22:
					$this->minion23($sender);
					break;

				case 23:
					$this->minion24($sender);
					break;

				case 24:
					$this->minion29($sender);
					break;

				case 25:
					$this->cui($sender);
					break;
			}
		});
		$form->setTitle("§l§6MINION RECIPES");
		$form->setContent("§dSelect The Which Minion Recipe You Want:", 0,);
		$form->addButton("§l§eCOBBLESTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eCOAL MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eIRON MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eGOLD MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eLAPIS MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eREDSTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eDIAMOND MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eEMERALD MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eNETHER QUARTZ MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eNETHERRACK MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eENDSTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eWHEAT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eCARROT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§ePOTATO MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eMELON MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§ePUMPKIN MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eDIRT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eSAND MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eOAK LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eACACIA LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eBIRCH LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eSPRUCE LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eJUNGLE LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eDARK OAK MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§eSNOW MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armors($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->armor1($sender);
					break;

				case 1:
					$this->armor2($sender);
					break;

				case 2:
					$this->armor3($sender);
					break;

				case 3:
					$this->armor4($sender);
					break;

				case 4:
					$this->armor5($sender);
					break;

				case 5:
					$this->armor6($sender);
					break;

				case 6:
					$this->armor7($sender);
					break;

				case 7:
					$this->armor8($sender);
					break;

				case 8:
					$this->armor9($sender);
					break;

				case 9:
					$this->armor10($sender);
					break;

				case 10:
					$this->armor11($sender);
					break;

				case 11:
					$this->armor12($sender);
					break;

				case 12:
					$this->armor13($sender);
					break;

				case 13:
					$this->armor14($sender);
					break;

				case 14:
					$this->armor15($sender);
					break;

				case 15:
					$this->armor16($sender);
					break;

				case 16:
					$this->armor17($sender);
					break;

				case 17:
					$this->armor18($sender);
					break;

				case 18:
					$this->armor19($sender);
					break;

				case 19:
					$this->armor20($sender);
					break;

				case 20:
					$this->cui($sender);
					break;
			}
		});
		$form->setTitle("§l§6ARMOR RECIPES");
		$form->setContent("§dSelect The Which Armor Recipe You Want:", 0,);
		$form->addButton("§l§eGOD ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eMINER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eFARMER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eLAPIS ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eEND ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eGOLEM ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§ePUMPKIN ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eNETHER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eOAK ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eICE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eASSASSIN ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eTANK ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eWISE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eEMERALD ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eREDSTONE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eUNSTABLE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eSPIDER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eDIGGER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eTECHNO ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§eLIQUED ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function tools($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->tool1($sender);
					break;

				case 1:
					$this->tool2($sender);
					break;

				case 2:
					$this->tool3($sender);
					break;

				case 3:
					$this->tool4($sender);
					break;

				case 4:
					$this->tool5($sender);
					break;

				case 5:
					$this->item2($sender);
					break;

				case 6:
					$this->cui($sender);
					break;
			}
		});
		$form->setTitle("§l§6TOOL RECIPES");
		$form->setContent("§dSelect The Which Tool Recipe You Want:", 0,);
		$form->addButton("§l§eGOD SWORD\n§9»» §r§6Tap To View", 0, "textures/items/gold_sword");
		$form->addButton("§l§eEND SWORD\n§9»» §r§6Tap To View", 0, "textures/items/diamond_sword");
		$form->addButton("§l§eGOLEM SWORD\n§9»» §r§6Tap To View", 0, "textures/items/iron_sword");
		$form->addButton("§l§eRABBIT SWORD\n§9»» §r§6Tap To View", 0, "textures/items/stone_sword");
		$form->addButton("§l§eRUNAAN'S BOW\n§9»» §r§6Tap To View", 0, "textures/items/bow_pulling_2");
		$form->addButton("§l§eGRAPPLING HOOK\n§9»» §r§6Tap To View", 0, "textures/items/fishing_rod_uncast");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function items($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->item6($sender);
					break;

				case 1:
					$this->item8($sender);
					break;

				case 2:
					$this->item9($sender);
					break;

				case 3:
					$this->item10($sender);
					break;

				case 4:
					$this->bucket1($sender);
					break;

				case 5:
					$this->bucket2($sender);
					break;

				case 6:
					$this->cui($sender);
			}
		});
		$form->setTitle("§l§6CUSTOM ITEMS RECIPES");
		$form->setContent("§dSelect The Which Item Recipe You Want:", 0,);
		$form->addButton("§l§eDRAGON'S BREATH\n§9»» §r§6Tap To View", 0, "textures/items/dragons_breath");
		$form->addButton("§l§eSUPER SMELTER\n§9»» §r§6Tap To Get", 0, "textures/blocks/furnace_front_off");
		$form->addButton("§l§eSUPER COMPACTER\n§9»» §r§6Tap To Get", 0, "textures/blocks/dispenser_front_horizontal");
		$form->addButton("§l§eSUPER EXPANDER\n§9»» §r§6Tap To Get", 0, "textures/blocks/command_block");
		$form->addButton("§l§eINFINITE WATER\n§9»» §r§6Tap To Get", 0, "textures/items/bucket_water");
		$form->addButton("§l§eINFINITE LAVA\n§9»» §r§6Tap To Get", 0, "textures/items/bucket_lava");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function eblocks($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->block1($sender);
					break;

				case 1:
					$this->block2($sender);
					break;

				case 2:
					$this->block3($sender);
					break;

				case 3:
					$this->block4($sender);
					break;

				case 4:
					$this->block5($sender);
					break;

				case 5:
					$this->block6($sender);
					break;

				case 6:
					$this->block7($sender);
					break;

				case 7:
					$this->block8($sender);
					break;

				case 8:
					$this->block9($sender);
					break;

				case 9:
					$this->block10($sender);
					break;

				case 10:
					$this->block11($sender);
					break;

				case 11:
					$this->block12($sender);
					break;

				case 12:
					$this->block13($sender);
					break;

				case 13:
					$this->block14($sender);
					break;

				case 14:
					$this->block15($sender);
					break;

				case 15:
					$this->block16($sender);
					break;

				case 16:
					$this->block17($sender);
					break;

				case 17:
					$this->block18($sender);
					break;

				case 18:
					$this->block19($sender);
					break;

				case 19:
					$this->block20($sender);
					break;

				case 20:
					$this->block21($sender);
					break;

				case 21:
					$this->block22($sender);
					break;

				case 22:
					$this->block23($sender);
					break;

				case 23:
					$this->block24($sender);
					break;

				case 24:
					$this->block25($sender);
					break;

				case 25:
					$this->block26($sender);
					break;

				case 26:
					$this->block27($sender);
					break;

				case 27:
					$this->block28($sender);
					break;

				case 28:
					$this->block29($sender);
					break;

				case 29:
					$this->cui($sender);
					break;
			}
		});
		$form->setTitle("§l§6ENCHANTED BLOCKS RECIPES");
		$form->setContent("§dSelect The Which Enchanted Item Recipe You Want:", 0,);
		$form->addButton("§l§eENCHANTED COBBLESTONE\n§9»» §r§6Tap To View", 0, "textures/blocks/cobblestone");
		$form->addButton("§l§eENCHANTED COAL\n§9»» §r§6Tap To View", 0, "textures/items/coal");
		$form->addButton("§l§eENCHANTED IRON\n§9»» §r§6Tap To View", 0, "textures/items/iron_ingot");
		$form->addButton("§l§eENCHANTED GOLD\n§9»» §r§6Tap To View", 0, "textures/items/gold_ingot");
		$form->addButton("§l§eENCHANTED LAPIS\n§9»» §r§6Tap To View", 0, "textures/items/dye_powder_blue");
		$form->addButton("§l§eENCHANTED REDSTONE\n§9»» §r§6Tap To View", 0, "textures/items/redstone_dust");
		$form->addButton("§l§eENCHANTED DIAMOND\n§9»» §r§6Tap To View", 0, "textures/items/diamond");
		$form->addButton("§l§eENCHANTED EMERALD\n§9»» §r§6Tap To View", 0, "textures/items/emerald");
		$form->addButton("§l§eENCHANTED NETHER QUARTZ\n§9»» §r§6Tap To View", 0, "textures/items/quartz");
		$form->addButton("§l§eENCHANTED NETHERRACK\n§9»» §r§6Tap To View", 0, "textures/blocks/netherrack");
		$form->addButton("§l§eENCHANTED ENDSTONE\n§9»» §r§6Tap To View", 0, "textures/blocks/end_stone");
		$form->addButton("§l§eENCHANTED WHEAT\n§9»» §r§6Tap To View", 0, "textures/items/wheat");
		$form->addButton("§l§eENCHANTED CARROT\n§9»» §r§6Tap To View", 0, "textures/items/carrot");
		$form->addButton("§l§eENCHANTED POTATO\n§9»» §r§6Tap To View", 0, "textures/items/potato");
		$form->addButton("§l§eENCHANTED MELON\n§9»» §r§6Tap To View", 0, "textures/blocks/melon_side");
		$form->addButton("§l§eENCHANTED PUMPKIN\n§9»» §r§6Tap To View", 0, "textures/blocks/pumpkin_side");
		$form->addButton("§l§eENCHANTED DIRT\n§9»» §r§6Tap To View", 0, "textures/blocks/dirt");
		$form->addButton("§l§eENCHANTED SAND\n§9»» §r§6Tap To View", 0, "textures/blocks/sand");
		$form->addButton("§l§eENCHANTED OAK LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_oak");
		$form->addButton("§l§eENCHANTED ACACIA LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_acacia");
		$form->addButton("§l§eENCHANTED BIRCH LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_birch");
		$form->addButton("§l§eENCHANTED SPRUCE LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_spruce");
		$form->addButton("§l§eENCHANTED JUNGLE LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_jungle");
		$form->addButton("§l§eENCHANTED DARK OAK LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_big_oak");
		$form->addButton("§l§eENCHANTED STEAK\n§9»» §r§6Tap To View", 0, "textures/items/beef_cooked");
		$form->addButton("§l§eENCHANTED CHICKEN\n§9»» §r§6Tap To View", 0, "textures/items/chicken_cooked");
		$form->addButton("§l§eENCHANTED MUTTON\n§9»» §r§6Tap To View", 0, "textures/items/mutton_cooked");
		$form->addButton("§l§eENCHANTED PORKCHOP\n§9»» §r§6Tap To View", 0, "textures/items/porkchop_cooked");
		$form->addButton("§l§eENCHANTED SNOW\n§9»» §r§6Tap To View", 0, "textures/blocks/snow");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor1($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			if ($data === null) {
				return true;
			}
			switch ($data) {
				case 0:
					$this->helmet1($sender);
					break;

				case 1:
					$this->chestplate1($sender);
					break;

				case 2:
					$this->leggings1($sender);
					break;

				case 3:
					$this->boots1($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6GOD ARMOR RECIPE");
		$form->setContent("§dSelect The Which God Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eGOD HELMET\n§9»» §r§6Tap To View", 0, "textures/items/gold_helmet");
		$form->addButton("§l§eGOD CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/gold_chestplate");
		$form->addButton("§l§eGOD LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/gold_leggings");
		$form->addButton("§l§eGOD BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/gold_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}
	
	public function armor2($sender)
	{
		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet2($sender);
					break;

				case 1:
					$this->chestplate2($sender);
					break;

				case 2:
					$this->leggings2($sender);
					break;

				case 3:
					$this->boots2($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6MINER ARMOR RECIPE");
		$form->setContent("§dSelect The Which Miner Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eMINER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eMINER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eMINER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eMINER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor3($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet3($sender);
					break;

				case 1:
					$this->chestplate3($sender);
					break;

				case 2:
					$this->leggings3($sender);
					break;

				case 3:
					$this->boots3($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6FARMER ARMOR RECIPE");
		$form->setContent("§dSelect The Which Farmer Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eFARMER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eFARMER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eFARMER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eFARMER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor4($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet4($sender);
					break;

				case 1:
					$this->chestplate4($sender);
					break;

				case 2:
					$this->leggings4($sender);
					break;

				case 3:
					$this->boots4($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6LAPIS ARMOR RECIPE");
		$form->setContent("§dSelect The Which Lapis Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eLAPIS HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eLAPIS CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eLAPIS LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eLAPIS BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor5($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet5($sender);
					break;

				case 1:
					$this->chestplate5($sender);
					break;

				case 2:
					$this->leggings5($sender);
					break;

				case 3:
					$this->boots5($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6END ARMOR RECIPE");
		$form->setContent("§dSelect The Which End Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eEND HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eEND CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eEND LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eEND BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor6($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet6($sender);
					break;

				case 1:
					$this->chestplate6($sender);
					break;

				case 2:
					$this->leggings6($sender);
					break;

				case 3:
					$this->boots6($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6GOLEM ARMOR RECIPE");
		$form->setContent("§dSelect The Which Golem Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eGOLEM HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eGOLEM CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eGOLEM LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eGOLEM BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor7($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet7($sender);
					break;

				case 1:
					$this->chestplate7($sender);
					break;

				case 2:
					$this->leggings7($sender);
					break;

				case 3:
					$this->boots7($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6PUMPKIN ARMOR RECIPE");
		$form->setContent("§dSelect The Which Pumpkin Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§ePUMPKIN HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§ePUMPKIN CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§ePUMPKIN LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§ePUMPKIN BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor8($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet8($sender);
					break;

				case 1:
					$this->chestplate8($sender);
					break;

				case 2:
					$this->leggings8($sender);
					break;

				case 3:
					$this->boots8($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6NETHER ARMOR RECIPE");
		$form->setContent("§dSelect The Which Nether Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eNETHER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eNETHER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eNETHER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eNETHER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor9($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet9($sender);
					break;

				case 1:
					$this->chestplate9($sender);
					break;

				case 2:
					$this->leggings9($sender);
					break;

				case 3:
					$this->boots9($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6OAK ARMOR RECIPE");
		$form->setContent("§dSelect The Which Oak Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eOAK HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eOAK CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eOAK LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eOAK BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor10($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet10($sender);
					break;

				case 1:
					$this->chestplate10($sender);
					break;

				case 2:
					$this->leggings10($sender);
					break;

				case 3:
					$this->boots10($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6ICE ARMOR RECIPE");
		$form->setContent("§dSelect The Which Ice Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eICE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eICE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eICE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eICE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor11($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet11($sender);
					break;

				case 1:
					$this->chestplate11($sender);
					break;

				case 2:
					$this->leggings11($sender);
					break;

				case 3:
					$this->boots11($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6ASSASSIN ARMOR RECIPE");
		$form->setContent("§dSelect The Which Assassin Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eASSASSIN HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eASSASSIN CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eASSASSIN LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eASSASSIN BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor12($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet12($sender);
					break;

				case 1:
					$this->chestplate12($sender);
					break;

				case 2:
					$this->leggings12($sender);
					break;

				case 3:
					$this->boots12($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6TANK ARMOR RECIPE");
		$form->setContent("§dSelect The Which Tank Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eTANK HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eTANK CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eTANK LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eTANK BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor13($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet13($sender);
					break;

				case 1:
					$this->chestplate13($sender);
					break;

				case 2:
					$this->leggings13($sender);
					break;

				case 3:
					$this->boots13($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6WISE ARMOR RECIPE");
		$form->setContent("§dSelect The Which Wise Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eWISE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eWISE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eWISE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eWISE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor14($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet14($sender);
					break;

				case 1:
					$this->chestplate14($sender);
					break;

				case 2:
					$this->leggings14($sender);
					break;

				case 3:
					$this->boots14($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6EMERALD ARMOR RECIPE");
		$form->setContent("§dSelect The Which Emerald Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eEMERALD HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eEMERALD CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eEMERALD LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eEMERALD BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor15($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet15($sender);
					break;

				case 1:
					$this->chestplate15($sender);
					break;

				case 2:
					$this->leggings15($sender);
					break;

				case 3:
					$this->boots15($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6REDSTONE ARMOR RECIPE");
		$form->setContent("§dSelect The Which Redstone Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eREDSTONE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eREDSTONE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eREDSTONE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eREDSTONE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor16($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet16($sender);
					break;

				case 1:
					$this->chestplate16($sender);
					break;

				case 2:
					$this->leggings16($sender);
					break;

				case 3:
					$this->boots16($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6UNSTABLE ARMOR RECIPE");
		$form->setContent("§dSelect The Which Unstable Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eUNSTABLE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eUNSTABLE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eUNSTABLE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eUNSTABLE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor17($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet17($sender);
					break;

				case 1:
					$this->chestplate17($sender);
					break;

				case 2:
					$this->leggings17($sender);
					break;

				case 3:
					$this->boots17($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6SPIDER ARMOR RECIPE");
		$form->setContent("§dSelect The Which Spider Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eSPIDER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eSPIDER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eSPIDER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eSPIDER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor18($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet18($sender);
					break;

				case 1:
					$this->chestplate18($sender);
					break;

				case 2:
					$this->leggings18($sender);
					break;

				case 3:
					$this->boots18($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6DIGGER ARMOR RECIPE");
		$form->setContent("§dSelect The Which Digger Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eDIGGER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eDIGGER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eDIGGER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eDIGGER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor19($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet19($sender);
					break;

				case 1:
					$this->chestplate19($sender);
					break;

				case 2:
					$this->leggings19($sender);
					break;

				case 3:
					$this->boots19($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6TECHNO ARMOR RECIPE");
		$form->setContent("§dSelect The Which Techno Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eTECHNO HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eTECHNO CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eTECHNO LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eTECHNO BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function armor20($sender)
	{


		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->helmet20($sender);
					break;

				case 1:
					$this->chestplate20($sender);
					break;

				case 2:
					$this->leggings20($sender);
					break;

				case 3:
					$this->boots20($sender);
					break;

				case 4:
					$this->armors($sender);
					break;
			}
		});
		$form->setTitle("§l§6LIQUED ARMOR RECIPE");
		$form->setContent("§dSelect The Which Liqued Armor Piece Recipe You Want:", 0,);
		$form->addButton("§l§eLIQUED HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
		$form->addButton("§l§eLIQUED CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
		$form->addButton("§l§eLIQUED LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
		$form->addButton("§l§eLIQUED BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}

	public function minion1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6COBBLESTONE MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eCobblestone Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6COAL MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eCoal Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6IRON MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eIron Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLD MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eGold Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eLapis Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(331, 0, 65));
		$inventory->setItem(21, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eRedstone Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIAMOND MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eDiamond Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eEmerald Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER QUARTZ MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eNether Quartz Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHERRACK MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eNetherrack Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENDSTONE MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(274, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eEndstone Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6WHEAT MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(291, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eWheat Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6CARROT MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(291, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eCarrot Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6POTATO MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(291, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§ePotato Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MELON MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eMelon Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PUMPKIN MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§ePumpkin Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIRT MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(273, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eDirt Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SAND MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(273, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eSand Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6OAK LOG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eOak Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ACACIA LOG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eAcacia Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion21($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6BIRCH LOG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eBirch Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion22($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SPRUCE LOG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eSpruce Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion23($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6JUNGLE LOG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eJungle Log Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion24($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DARK OAK MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(275, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eDark Oak Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion25($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6COW MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(272, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eCow Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion26($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PIG MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(272, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§ePig Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion27($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SHEEP MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(272, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eSheep Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion28($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6CHICKEN MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(272, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eChicken Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function minion29($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SNOW MINION");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(273, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 3, 1)->setCustomName("§r§l§eSnow Minion"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOD SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(57, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(57, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(283, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(283, 0, 1)->setCustomName("§r§l§eGod Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(57, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(57, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6RABBIT SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(272, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(272, 0, 1)->setCustomName("§r§l§eRabbit Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(165, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6END SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(276, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(276, 0, 1)->setCustomName("§r§l§eEnd Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(381, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TELEKANISES SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(276, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(276, 0, 1)->setCustomName("§r§l§eTelekanises Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SMELT SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(276, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(276, 0, 1)->setCustomName("§r§l§eSmelt Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TELEKANISES PICKAXE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(278, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(278, 0, 1)->setCustomName("§r§l§eTelekanises Pickaxe"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SMELT PICKAXE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(278, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(278, 0, 1)->setCustomName("§r§l§eSmelt Pickaxe"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TELEKANISES AXE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(279, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(279, 0, 1)->setCustomName("§r§l§eTelekanises Axe"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SMELT AXE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(279, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(279, 0, 1)->setCustomName("§r§l§eSmelt Axe"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TELEKANISES SHOVEL");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(277, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(277, 0, 1)->setCustomName("§r§l§eTelekanises Shovel"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 5)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SMELT SHOVEL");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(277, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(277, 0, 1)->setCustomName("§r§l§eSmelt Shovel"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 5)->setCustomName("§r§l§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLEM SWORD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(267, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(267, 0, 1)->setCustomName("§r§l§eGolem Sword"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(46, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function tool5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6RUNAAN'S BOW");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(399, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(399, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(261, 0, 1));
		$inventory->setItem(31, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(261, 0, 1)->setCustomName("§r§l§eRunaan's Bow"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(399, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(399, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6HAMMER");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(264, 0, 16));
		$inventory->setItem(21, ItemFactory::getInstance()->get(264, 0, 16));
		$inventory->setItem(22, ItemFactory::getInstance()->get(264, 0, 16));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(0, 0, 16));
		$inventory->setItem(30, ItemFactory::getInstance()->get(280, 0, 16));
		$inventory->setItem(31, ItemFactory::getInstance()->get(264, 0, 16));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(257, 0, 1)->setCustomName("§r§l§eHammer"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(280, 0, 16));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 1));
		$inventory->setItem(40, ItemFactory::getInstance()->get(264, 0, 16));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GRAPPLING HOOK");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(280, 0, 16));
		$inventory->setItem(21, ItemFactory::getInstance()->get(287, 0, 16));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 16));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(280, 0, 16));
		$inventory->setItem(30, ItemFactory::getInstance()->get(287, 0, 16));
		$inventory->setItem(31, ItemFactory::getInstance()->get(287, 0, 16));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(346, 0, 1)->setCustomName("§r§l§eGrappling Hook"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(280, 0, 16));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 1));
		$inventory->setItem(40, ItemFactory::getInstance()->get(287, 0, 16));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER STAR");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(21, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(22, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(30, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(31, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(399, 0, 1)->setCustomName("§r§l§eNether Star"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(39, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(40, ItemFactory::getInstance()->get(7, 0, 5));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6BEDROCK");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(21, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(22, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(30, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(31, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(7, 0, 1)->setCustomName("§r§l§eBedrock"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(39, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(40, ItemFactory::getInstance()->get(437, 0, 5));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6BLAZE POWDER");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(21, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(22, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(30, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(31, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(377, 0, 1)->setCustomName("§r§l§eBlaze Powder"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(39, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(40, ItemFactory::getInstance()->get(57, 0, 20));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DRAGON'S BREATH");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(437, 0, 12)->setCustomName("§r§l§eDragon's Breath"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(49, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DRAGON'S HEAD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(21, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(397, 5, 1)->setCustomName("§r§l§eDragon's Head"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(39, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(7, 0, 64));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SUPER SMELTER");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(61, 0, 1)->setCustomName("§r§l§eSuper Smelter"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}
	
	public function item9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SUPER COMPACTER");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(23, 0, 1)->setCustomName("§r§l§eSuper Compacter"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§eEnchanted Gold Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function item10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SUPER EXPANDER");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(137, 0, 1)->setCustomName("§r§l§eSuper Expander"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§eEnchanted Iron Ingot"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED COBBLESTONE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§r§l§eEnchanted Cobblestone"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED COAL");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§r§l§eEnchanted Coal"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(263, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED IRON");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§r§l§eEnchanted Iron"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(265, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED GOLD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(266, 0, 64)->setCustomName("§r§l§eEnchanted Gold"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(266, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED LAPIS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§r§l§eEnchanted Lapis"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(351, 4, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED REDSTONE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(331, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§r§l§eEnchanted Redstone"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(331, 0, 1));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED DIAMOND");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(264, 0, 64)->setCustomName("§r§l§eEnchanted Diamond"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(264, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED EMERALD");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§r§l§eEnchanted Emerald"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(388, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED QUARTZ");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(406, 0, 64)->setCustomName("§r§l§eEnchanted Nether Quartz"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(406, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED NETHERRACK");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§r§l§eEnchanted Netherrack"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(87, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED ENDSTONE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§r§l§eEnchanted Endstone"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(121, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED WHEAT");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§r§l§eEnchanted Wheat"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(296, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED CARROT");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(391, 0, 64)->setCustomName("§r§l§eEnchanted Carrot"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(391, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED POTATO");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§r§l§eEnchanted Potato"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(392, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED MELON");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§r§l§eEnchanted Melon"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(103, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED PUMPKIN");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§r§l§eEnchanted Pumpkin"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(86, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED DIRT");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§r§l§eEnchanted Dirt"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(3, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED SAND");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§r§l§eEnchanted Sand"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(12, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED OAK LOG");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§r§l§eEnchanted Oak Log"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED ACACIA LOG");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§r§l§eEnchanted Acacia Log"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(162, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block21($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED BIRCH LOG");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(17, 2, 64)->setCustomName("§r§l§eEnchanted Birch Log"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 2, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block22($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED SPRUCE LOG");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(17, 1, 64)->setCustomName("§r§l§eEnchanted Spruce Log"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 1, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block23($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED JUNGLE LOG");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(17, 3, 64)->setCustomName("§r§l§eEnchanted Jungle Log"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 3, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block24($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED DARK OAK");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(162, 1, 64)->setCustomName("§r§l§eEnchanted Dark Oak"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(162, 1, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block25($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED STEAK");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(363, 0, 64)->setCustomName("§r§l§eEnchanted Steak"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(363, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block26($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED CHICKEN");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§r§l§eEnchanted Chicken"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(365, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block27($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED MUTTON");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(74, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(423, 0, 64)->setCustomName("§r§l§eEnchanted Mutton"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(423, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block28($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED PORKCHOP");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§r§l§eEnchanted Porkchop"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(319, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function block29($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ENCHANTED SNOW");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(21, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(30, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§r§l§eEnchanted Snow"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(80, 0, 64));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOD HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eGod Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MINER HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eMiner Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6FARMER HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eFarmer Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eLapis Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6END HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eEnd Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLEM HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eGolem Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PUMPKIN HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§ePumpkin Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eNether Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6OAK HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eOak Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ICE HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eIce Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ASSASSIN HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eAssassin Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TANK HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eTank Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6WISE HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eWise Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eEmerald Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(332, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eRedstone Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6UNSTABLE HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eUnstable Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SPIDER HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eSpider Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIGGER HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eDigger Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TECHNO HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eTechno Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function helmet20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LIQUED HELMET");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(302, 0, 1)->setCustomName("§r§l§eLiqued Helmet"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOD CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eGod Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MINER CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eMiner Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6FARMER CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eFarmer Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eLapis Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6END CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eEnd Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLEM CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eGolem Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PUMPKIN CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§ePumpkin Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eNether Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6OAK CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eOak Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ICE CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eIce Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ASSASSIN CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eAssassin Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TANK CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eTank Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6WISE CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eWise Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eEmerald Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(332, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eRedstone Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6UNSTABLE CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eUnstable Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SPIDER CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eSpider Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIGGER CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eDigger Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TECHNO CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eTechno Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function chestplate20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LIQUED CHESTPLATE");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(303, 0, 1)->setCustomName("§r§l§eLiqued Chestplate"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(40, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOD LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eGod Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}


	public function leggings2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MINER LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eMiner Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6FARMER LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eFarmer Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eLapis Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6END LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eEnd Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLEM LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eGolem Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PUMPKIN LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§ePumpkin Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eNether Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6OAK LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eOak Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ICE LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eIce Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ASSASSIN LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eAssassin Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TANK LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eTank Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6WISE LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eWise Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eEmerald Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(332, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eRedstone Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6UNSTABLE LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eUnstable Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SPIDER LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eSpider Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIGGER LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eDigger Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TECHNO LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eTechno Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function leggings20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LIQUED LEGGINGS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(304, 0, 1)->setCustomName("§r§l§eLiqued Leggings"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOD BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(437, 0, 64)->setCustomName("§l§eDragon Breath"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eGod Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MINER BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(4, 0, 64)->setCustomName("§l§eEnchanted Cobblestone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eMiner Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6FARMER BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(296, 0, 64)->setCustomName("§l§eEnchanted Wheat"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eFarmer Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(351, 4, 64)->setCustomName("§l§eEnchanted Lapis"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eLapis Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6END BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(121, 0, 64)->setCustomName("§l§eEnchanted Endstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eEnd Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLEM BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(265, 0, 64)->setCustomName("§l§eEnchanted Iron"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eGolem Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6PUMPKIN BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(86, 0, 64)->setCustomName("§l§eEnchanted Pumpkin"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§ePumpkin Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots8($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6NETHER BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(87, 0, 64)->setCustomName("§l§eEnchanted Netherrack"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eNether Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots9($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6OAK BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(17, 0, 64)->setCustomName("§l§eEnchanted Oak Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eOak Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots10($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ICE BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(80, 0, 64)->setCustomName("§l§eEnchanted Snow"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eIce Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots11($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6ASSASSIN BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(12, 0, 64)->setCustomName("§l§eEnchanted Sand"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eAssassin Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots12($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TANK BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(392, 0, 64)->setCustomName("§l§eEnchanted Potato"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eTank Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots13($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6WISE BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(319, 0, 64)->setCustomName("§l§eEnchanted Porkchop"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eWise Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots14($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(388, 0, 64)->setCustomName("§l§eEnchanted Emerald"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eEmerald Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots15($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(331, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(332, 0, 64)->setCustomName("§l§eEnchanted Redstone"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eRedstone Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots16($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6UNSTABLE BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(263, 0, 64)->setCustomName("§l§eEnchanted Coal"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eUnstable Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots17($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6SPIDER BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(365, 0, 64)->setCustomName("§l§eEnchanted Chicken"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eSpider Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots18($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIGGER BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(3, 0, 64)->setCustomName("§l§eEnchanted Dirt"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eDigger Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots19($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6TECHNO BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(162, 0, 64)->setCustomName("§l§eEnchanted Acacia Log"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eTechno Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}

	public function boots20($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LIQUED BOOTS");
		$inventory = $menu->getInventory();
		$inventory->setItem(0, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(1, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(2, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(3, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(4, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(5, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(6, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(7, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(8, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(9, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(10, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(11, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(12, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(13, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(14, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(15, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(16, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(17, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(18, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(19, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(20, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(21, ItemFactory::getInstance()->get(0, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(22, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(23, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(24, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(25, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(26, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(27, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(28, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(29, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(30, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(31, ItemFactory::getInstance()->get(103, 0, 64)->setCustomName("§l§eEnchanted Melon"));
		$inventory->setItem(32, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(33, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(34, ItemFactory::getInstance()->get(305, 0, 1)->setCustomName("§r§l§eLiqued Boots"));
		$inventory->setItem(35, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(36, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(37, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(38, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(39, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(40, ItemFactory::getInstance()->get(0, 0, 0));
		$inventory->setItem(41, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(42, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(43, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(44, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(45, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(46, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(47, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(48, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(49, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(50, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(51, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(52, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$inventory->setItem(53, ItemFactory::getInstance()->get(95, 15, 1)->setCustomName("§r"));
		$menu->send($sender);
		return true;
	}
	
	public function ore($sender)
	{

		$form = new SimpleForm(function (Player $sender, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch ($result) {
				case 0:
					$this->ore1($sender);
					break;

				case 1:
					$this->ore2($sender);
					break;

				case 2:
					$this->ore3($sender);
					break;

				case 3:
					$this->ore4($sender);
					break;

				case 4:
					$this->ore5($sender);
					break;

				case 5:
					$this->ore6($sender);
					break;

				case 6:
					$this->ore7($sender);
					break;

				case 7:
					$this->cui($sender);
					break;
			}
		});
		$form->setTitle("§l§6ORE SPAWNER RECIPES");
		$form->setContent("§dSelect The Which Ore Spawner Recipe You Want:", 0,);
		$form->addButton("§l§eCOAL SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/coal");
		$form->addButton("§l§eIRON SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/iron_ingot");
		$form->addButton("§l§eGOLD SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/gold_ingot");
		$form->addButton("§l§eLAPIS SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/dye_powder_blue");
		$form->addButton("§l§eREDSTONE SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/redstone_dust");
		$form->addButton("§l§eDIAMOND SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/diamond");
		$form->addButton("§l§eEMERALD SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/emerald");
		$form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
		$sender->sendForm($form);
		return $form;
	}
	
	public function ore1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6COAL ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(263, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(232, 0, 1)->setCustomName("§r§eCOAL ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}

	public function ore2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6IRON ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(265, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(220, 0, 1)->setCustomName("§r§eIRON ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}
	
	public function ore3($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6GOLD ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(266, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(224, 0, 1)->setCustomName("§r§eGOLD ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}

	public function ore4($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6LAPIS ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(351, 4, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(231, 0, 1)->setCustomName("§r§eLAPIS ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}
	
	public function ore5($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6REDSTONE ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(331, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(234, 0, 1)->setCustomName("§r§eREDSTONE ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}
	
	public function ore6($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6DIAMOND ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(264, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(223, 0, 1)->setCustomName("§r§eDIAMOND ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}

	public function ore7($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6EMERALD ORE SPAWNER");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(11, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(12, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(19, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(21, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(28, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(29, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(30, ItemFactory::getInstance()->get(388, 0, 64));
		$menu->getInventory()->setItem(24, ItemFactory::getInstance()->get(225, 0, 1)->setCustomName("§r§eEMERALD ORE SPAWNER"));
		$menu->send($sender);
		return true;
	}
	
	public function bucket1($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MAGICAL WATER");
		$item1 = ItemFactory::getInstance()->get(325, 8, 1);
		$item1->getNamedTag()->setTag(Item::TAG_ENCH, new ListTag([Item::TAG_ENCH], NBT::TAG_Compound));
		$item1->setCustomName("§r§eMAGICAL WATER");
		$item2 = ItemFactory::getInstance()->get(351, 4, 32);
		$item2->getNamedTag()->setTag(Item::TAG_ENCH, new ListTag([Item::TAG_ENCH], NBT::TAG_Compound));
		$item2->setCustomName("§r§eENCHANTED LAPIS LAZULI");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, $item2);
		$menu->getInventory()->setItem(11, $item2);
		$menu->getInventory()->setItem(12, $item2);
		$menu->getInventory()->setItem(19, $item2);
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(325, 8, 1));
		$menu->getInventory()->setItem(21, $item2);
		$menu->getInventory()->setItem(28, $item2);
		$menu->getInventory()->setItem(29, $item2);
		$menu->getInventory()->setItem(30, $item2);
		$menu->getInventory()->setItem(24, $item1);
		$menu->send($sender);
		return true;
	}
	
	public function bucket2($sender)
	{
		$menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$menu->setListener(InvMenu::readonly());
		$menu->setName("§l§6MAGICAL LAVA");
		$item1 = ItemFactory::getInstance()->get(325, 10, 1);
		$item1->getNamedTag()->setTag(Item::TAG_ENCH, new ListTag([Item::TAG_ENCH], NBT::TAG_Compound));
		$item1->setCustomName("§r§eMAGICAL LAVA");
		$item2 = ItemFactory::getInstance()->get(331, 0, 32);
		$item2->getNamedTag()->setTag(Item::TAG_ENCH, new ListTag([Item::TAG_ENCH], NBT::TAG_Compound));
		$item2->setCustomName("§r§eENCHANTED REDSTONE");
		$menu->getInventory()->setContents(array_fill(0, 54, ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 15)->setCustomName(TextFormat::RESET)));
		$menu->getInventory()->setItem(10, $item2);
		$menu->getInventory()->setItem(11, $item2);
		$menu->getInventory()->setItem(12, $item2);
		$menu->getInventory()->setItem(19, $item2);
		$menu->getInventory()->setItem(20, ItemFactory::getInstance()->get(325, 10, 1));
		$menu->getInventory()->setItem(21, $item2);
		$menu->getInventory()->setItem(28, $item2);
		$menu->getInventory()->setItem(29, $item2);
		$menu->getInventory()->setItem(30, $item2);
		$menu->getInventory()->setItem(24, $item1);
		$menu->send($sender);
		return true;
	}
}
