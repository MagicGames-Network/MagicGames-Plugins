<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use jojoe77777\FormAPI\Form;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use jojoe77777\FormAPI\SimpleForm;

class RecipesForm extends MenuForm
{
    public function __construct()
    {
        parent::__construct("§l§6RECIPES BOOK", "§bUse Only Custom Crafting Table To Craft Things, Do /customtable", [
            new MenuOption("§l§eMINION RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/891/891978.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eARMOR RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/361/361761.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eSWORD RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://i.imgur.com/EEaIm1N.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eAXE RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://i.imgur.com/PcovRG3.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§ePICKAXE RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://i.imgur.com/Ao5AHLx.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eRUNES RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://i.imgur.com/PEqPR8j.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eITEMS RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/487/487551.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eENCHANTED ITEMS\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3556/3556661.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eFOOD RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/2921/2921822.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eHOE RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/521/521021.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eWAND RECIPES\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/3204/3204021.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eTALISMAN\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/1625/1625674.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eORE GENERATOR\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/4831/4831062.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§eCUSTOM CRAFTING TABLE\n§9»» §r§6Tap To Open", new FormIcon("textures/blocks/crafting_table_top", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§l§dHELP\n§9»» §r§6Tap To Open\n§9»» §r§6Tap To Open", new FormIcon("https://cdn-icons-png.flaticon.com/128/2476/2476231.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§l§cClose\n§9»» §r§cTap To Close", new FormIcon("https://cdn-icons-png.flaticon.com/128/929/929416.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->minions($sender);
                    break;

                case 1:
                    $this->armors($sender);
                    break;

                case 2:
                    $this->sword($sender);
                    break;

                case 3:
                    $this->axe($sender);
                    break;

                case 4:
                    $this->pickaxe($sender);
                    break;
                    
                case 5:
                    $this->runes($sender);
                    break;

                case 6:
                    $this->items($sender);
                    break;

                case 7:
                    $this->eblocks($sender);
                    break;

                case 8:
                    $this->food($sender);
                    break;

                case 9:
                    $this->hoe($sender);
                    break;

                case 10:
                    $this->wand($sender);
                    break;

                case 11:
                    $sender->sendTitle("§r§l§eCOMMING SOON");
                    break;

                case 12:
                    $this->ore($sender);
                    break;

                case 13:
                    Server::getInstance()->dispatchCommand($sender, "customtable");
                    break;

                case 14:
                    $this->helpme($sender);
                    break;

                case 14:
                    break;
            }
        });
    }

    public function tools(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->sword($sender);
                    break;

                case 1:
                    $this->axe($sender);
                    break;

                case 2:
                    $this->pickaxe($sender);
                    break;

                case 3:
                    $this->items($sender);
                    break;

                case 4:
                    $this->hoe($sender);
                    break;

                case 5:
                    $this->wand($sender);
                    break;

                case 6:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM ITEMS RECIPES");
        $form->setContent("§dSelect The Which Tool Recipe You Want:");
        $form->addButton("§l§dSWORDS\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/2466/2466942.png");
        $form->addButton("§l§dAXE\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/6769/6769130.png");
        $form->addButton("§l§dPICKAXE\n§9»» §r§6Tap To View", 1, "https://i.imgur.com/l4cLq8v.png");
        $form->addButton("§l§dITEMS\n§9»» §r§6Tap To View", 1, "https://i.imgur.com/c4BNzS7.png");
        $form->addButton("§l§dHOE\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/521/521021.png");
        $form->addButton("§l§dWANDS\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/3204/3204021.png");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function helpme(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $name = $sender->getName();
        $form->setTitle("§l§6RECIPES HELP");
        $form->setContent("§bHi,§e $name \n\n§l§a» §6VIDEO MODE:§r §eFirst Go To Settings > Video > UI Profile > Classic§r\n\n§l§a» §6COMMAND:§r §eDo /customtable To Open Custom Table§r\n\n§l§a» §6ERROR:§r §eIf You Are Unable To Open Recipe Join Discord And See Recipe Channel");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function minions(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion1");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion3");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion4");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion5");
                    break;

                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion6");
                    break;

                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion7");
                    break;

                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion8");
                    break;

                case 8:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion9");
                    break;

                case 9:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion10");
                    break;

                case 10:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion11");
                    break;

                case 11:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion12");
                    break;

                case 12:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion13");
                    break;

                case 13:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion14");
                    break;

                case 14:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion15");
                    break;

                case 15:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion16");
                    break;

                case 16:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion17");
                    break;

                case 17:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion18");
                    break;

                case 18:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion19");
                    break;

                case 19:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion20");
                    break;

                case 20:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion21");
                    break;

                case 21:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion22");
                    break;

                case 22:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion23");
                    break;

                case 23:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion24");
                    break;

                case 24:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view minion25");
                    break;

                case 25:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6MINION RECIPES");
        $form->setContent("§dSelect The Which Minion Recipe You Want:");
        $form->addButton("§l§dCOBBLESTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dCOAL MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dIRON MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dGOLD MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dLAPIS MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dREDSTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dDIAMOND MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dEMERALD MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dNETHER QUARTZ MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dNETHERRACK MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dENDSTONE MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dWHEAT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dCARROT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dPOTATO MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dMELON MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dPUMPKIN MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dDIRT MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dSAND MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dOAK LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dACACIA LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dBIRCH LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dSPRUCE LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dJUNGLE LOG MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dDARK OAK MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§dSNOW MINION\n§9»» §r§6Tap To View", 1, "https://cdn-icons-png.flaticon.com/128/891/891978.png");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armors(Player $sender): Form
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
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6ARMOR RECIPES");
        $form->setContent("§dSelect The Which Armor Recipe You Want:");
        $form->addButton("§l§dGOD ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dMINER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dFARMER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dLAPIS ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dEND ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dGOLEM ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dPUMPKIN ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dNETHER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dOAK ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dICE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dASSASSIN ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dTANK ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dWISE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dEMERALD ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dREDSTONE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dUNSTABLE ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dSPIDER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dDIGGER ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dTECHNO ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§dLIQUED ARMOR\n§9»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/128/6010/6010434.png");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function eblocks(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec1");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec3");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec4");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec5");
                    break;

                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec6");
                    break;

                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec7");
                    break;

                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec8");
                    break;

                case 8:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec9");
                    break;

                case 9:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec10");
                    break;

                case 10:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec11");
                    break;

                case 11:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec12");
                    break;

                case 12:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec13");
                    break;

                case 13:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec14");
                    break;

                case 14:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec15");
                    break;

                case 15:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec16");
                    break;

                case 16:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec17");
                    break;

                case 17:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec18");
                    break;

                case 18:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec19");
                    break;

                case 19:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec20");
                    break;

                case 20:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec21");
                    break;

                case 21:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec22");
                    break;

                case 22:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec23");
                    break;

                case 23:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec24");
                    break;

                case 24:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec25");
                    break;

                case 25:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec26");
                    break;

                case 26:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec27");
                    break;

                case 27:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec28");
                    break;

                case 28:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ec29");
                    break;

                case 29:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6ENCHANTED BLOCKS RECIPES");
        $form->setContent("§dSelect The Which Enchanted Item Recipe You Want:");
        $form->addButton("§l§dENCHANTED COBBLESTONE\n§9»» §r§6Tap To View", 0, "textures/blocks/cobblestone");
        $form->addButton("§l§dENCHANTED COAL\n§9»» §r§6Tap To View", 0, "textures/items/coal");
        $form->addButton("§l§dENCHANTED IRON\n§9»» §r§6Tap To View", 0, "textures/items/iron_ingot");
        $form->addButton("§l§dENCHANTED GOLD\n§9»» §r§6Tap To View", 0, "textures/items/gold_ingot");
        $form->addButton("§l§dENCHANTED LAPIS\n§9»» §r§6Tap To View", 0, "textures/items/dye_powder_blue");
        $form->addButton("§l§dENCHANTED REDSTONE\n§9»» §r§6Tap To View", 0, "textures/items/redstone_dust");
        $form->addButton("§l§dENCHANTED DIAMOND\n§9»» §r§6Tap To View", 0, "textures/items/diamond");
        $form->addButton("§l§dENCHANTED EMERALD\n§9»» §r§6Tap To View", 0, "textures/items/emerald");
        $form->addButton("§l§dENCHANTED NETHER QUARTZ\n§9»» §r§6Tap To View", 0, "textures/items/quartz");
        $form->addButton("§l§dENCHANTED NETHERRACK\n§9»» §r§6Tap To View", 0, "textures/blocks/netherrack");
        $form->addButton("§l§dENCHANTED ENDSTONE\n§9»» §r§6Tap To View", 0, "textures/blocks/end_stone");
        $form->addButton("§l§dENCHANTED WHEAT\n§9»» §r§6Tap To View", 0, "textures/items/wheat");
        $form->addButton("§l§dENCHANTED CARROT\n§9»» §r§6Tap To View", 0, "textures/items/carrot");
        $form->addButton("§l§dENCHANTED POTATO\n§9»» §r§6Tap To View", 0, "textures/items/potato");
        $form->addButton("§l§dENCHANTED MELON\n§9»» §r§6Tap To View", 0, "textures/blocks/melon_side");
        $form->addButton("§l§dENCHANTED PUMPKIN\n§9»» §r§6Tap To View", 0, "textures/blocks/pumpkin_side");
        $form->addButton("§l§dENCHANTED DIRT\n§9»» §r§6Tap To View", 0, "textures/blocks/dirt");
        $form->addButton("§l§dENCHANTED SAND\n§9»» §r§6Tap To View", 0, "textures/blocks/sand");
        $form->addButton("§l§dENCHANTED OAK LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_oak");
        $form->addButton("§l§dENCHANTED ACACIA LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_acacia");
        $form->addButton("§l§dENCHANTED BIRCH LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_birch");
        $form->addButton("§l§dENCHANTED SPRUCE LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_spruce");
        $form->addButton("§l§dENCHANTED JUNGLE LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_jungle");
        $form->addButton("§l§dENCHANTED DARK OAK LOG\n§9»» §r§6Tap To View", 0, "textures/blocks/log_big_oak");
        $form->addButton("§l§dENCHANTED STEAK\n§9»» §r§6Tap To View", 0, "textures/items/beef_cooked");
        $form->addButton("§l§dENCHANTED CHICKEN\n§9»» §r§6Tap To View", 0, "textures/items/chicken_cooked");
        $form->addButton("§l§dENCHANTED MUTTON\n§9»» §r§6Tap To View", 0, "textures/items/mutton_cooked");
        $form->addButton("§l§dENCHANTED PORKCHOP\n§9»» §r§6Tap To View", 0, "textures/items/porkchop_cooked");
        $form->addButton("§l§dENCHANTED SNOW\n§9»» §r§6Tap To View", 0, "textures/blocks/snow");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor1(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet1");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest1");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg1");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot1");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6GOD ARMOR RECIPE");
        $form->setContent("§dSelect The Which God Armor Piece Recipe You Want:");
        $form->addButton("§l§dGOD HELMET\n§9»» §r§6Tap To View", 0, "textures/items/gold_helmet");
        $form->addButton("§l§dGOD CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/gold_chestplate");
        $form->addButton("§l§dGOD LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/gold_leggings");
        $form->addButton("§l§dGOD BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/gold_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function armor2(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet2");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg2");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot2");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6MINER ARMOR RECIPE");
        $form->setContent("§dSelect The Which Miner Armor Piece Recipe You Want:");
        $form->addButton("§l§dMINER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dMINER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dMINER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dMINER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor3(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet3");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest3");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg3");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot3");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6FARMER ARMOR RECIPE");
        $form->setContent("§dSelect The Which Farmer Armor Piece Recipe You Want:");
        $form->addButton("§l§dFARMER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dFARMER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dFARMER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dFARMER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor4(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet4");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest4");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg4");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot4");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6LAPIS ARMOR RECIPE");
        $form->setContent("§dSelect The Which Lapis Armor Piece Recipe You Want:");
        $form->addButton("§l§dLAPIS HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dLAPIS CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dLAPIS LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dLAPIS BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor5(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet5");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest5");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg5");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot5");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6END ARMOR RECIPE");
        $form->setContent("§dSelect The Which End Armor Piece Recipe You Want:");
        $form->addButton("§l§dEND HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dEND CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dEND LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dEND BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor6(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet6");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest6");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg6");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot6");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6GOLEM ARMOR RECIPE");
        $form->setContent("§dSelect The Which Golem Armor Piece Recipe You Want:");
        $form->addButton("§l§dGOLEM HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dGOLEM CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dGOLEM LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dGOLEM BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor7(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet7");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest7");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg7");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot7");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6PUMPKIN ARMOR RECIPE");
        $form->setContent("§dSelect The Which Pumpkin Armor Piece Recipe You Want:");
        $form->addButton("§l§dPUMPKIN HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dPUMPKIN CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dPUMPKIN LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dPUMPKIN BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor8(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet8");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest8");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg8");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot8");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6NETHER ARMOR RECIPE");
        $form->setContent("§dSelect The Which Nether Armor Piece Recipe You Want:");
        $form->addButton("§l§dNETHER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dNETHER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dNETHER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dNETHER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor9(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet9");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest9");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg9");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot9");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6OAK ARMOR RECIPE");
        $form->setContent("§dSelect The Which Oak Armor Piece Recipe You Want:");
        $form->addButton("§l§dOAK HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dOAK CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dOAK LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dOAK BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor10(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet10");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest10");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg10");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot10");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6ICE ARMOR RECIPE");
        $form->setContent("§dSelect The Which Ice Armor Piece Recipe You Want:");
        $form->addButton("§l§dICE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dICE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dICE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dICE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor11(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet11");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest11");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg11");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot11");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6ASSASSIN ARMOR RECIPE");
        $form->setContent("§dSelect The Which Assassin Armor Piece Recipe You Want:");
        $form->addButton("§l§dASSASSIN HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dASSASSIN CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dASSASSIN LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dASSASSIN BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor12(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet12");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest12");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg12");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot12");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6TANK ARMOR RECIPE");
        $form->setContent("§dSelect The Which Tank Armor Piece Recipe You Want:");
        $form->addButton("§l§dTANK HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dTANK CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dTANK LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dTANK BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor13(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet13");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest13");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg13");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot13");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6WISE ARMOR RECIPE");
        $form->setContent("§dSelect The Which Wise Armor Piece Recipe You Want:");
        $form->addButton("§l§dWISE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dWISE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dWISE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dWISE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor14(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet14");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest14");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg14");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot14");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6EMERALD ARMOR RECIPE");
        $form->setContent("§dSelect The Which Emerald Armor Piece Recipe You Want:");
        $form->addButton("§l§dEMERALD HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dEMERALD CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dEMERALD LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dEMERALD BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor15(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet15");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest15");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg15");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot15");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6REDSTONE ARMOR RECIPE");
        $form->setContent("§dSelect The Which Redstone Armor Piece Recipe You Want:");
        $form->addButton("§l§dREDSTONE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dREDSTONE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dREDSTONE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dREDSTONE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor16(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet16");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest16");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg16");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot16");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6UNSTABLE ARMOR RECIPE");
        $form->setContent("§dSelect The Which Unstable Armor Piece Recipe You Want:");
        $form->addButton("§l§dUNSTABLE HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dUNSTABLE CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dUNSTABLE LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dUNSTABLE BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor17(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet17");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest17");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg17");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot17");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6SPIDER ARMOR RECIPE");
        $form->setContent("§dSelect The Which Spider Armor Piece Recipe You Want:");
        $form->addButton("§l§dSPIDER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dSPIDER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dSPIDER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dSPIDER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor18(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet18");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest18");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg18");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot18");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6DIGGER ARMOR RECIPE");
        $form->setContent("§dSelect The Which Digger Armor Piece Recipe You Want:");
        $form->addButton("§l§dDIGGER HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dDIGGER CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dDIGGER LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dDIGGER BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor19(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet19");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest19");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg19");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot19");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6TECHNO ARMOR RECIPE");
        $form->setContent("§dSelect The Which Techno Armor Piece Recipe You Want:");
        $form->addButton("§l§dTECHNO HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dTECHNO CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dTECHNO LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dTECHNO BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function armor20(Player $sender): Form
    {


        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view helmet20");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view chest20");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view leg20");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view boot20");
                    break;

                case 4:
                    $this->armors($sender);
                    break;
            }
        });
        $form->setTitle("§l§6LIQUED ARMOR RECIPE");
        $form->setContent("§dSelect The Which Liqued Armor Piece Recipe You Want:");
        $form->addButton("§l§dLIQUED HELMET\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_helmet");
        $form->addButton("§l§dLIQUED CHESTPLATE\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§l§dLIQUED LEGGINGS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_leggings");
        $form->addButton("§l§dLIQUED BOOTS\n§9»» §r§6Tap To View", 0, "textures/items/chainmail_boots");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function ore(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore1");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore3");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore4");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore5");
                    break;

                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore6");
                    break;

                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view ore7");
                    break;

                case 7:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6ORE SPAWNER RECIPES");
        $form->setContent("§bSelect The Which Ore Spawner Recipe You Want:");
        $form->addButton("§l§dCOAL SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/coal");
        $form->addButton("§l§dIRON SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/iron_ingot");
        $form->addButton("§l§dGOLD SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/gold_ingot");
        $form->addButton("§l§dLAPIS SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/dye_powder_blue");
        $form->addButton("§l§dREDSTONE SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/redstone_dust");
        $form->addButton("§l§dDIAMOND SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/diamond");
        $form->addButton("§l§dEMERALD SPAWNER\n§9»» §r§6Tap To View", 0, "textures/items/emerald");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function sword(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword1");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword2");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword3");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword4");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword5");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword6");
                    break;
                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword7");
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword8");
                    break;
                case 8:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword9");
                    break;
                case 9:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword10");
                    break;
                case 10:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword11");
                    break;
                case 11:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword12");
                    break;
                case 12:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword13");
                    break;
                case 13:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view sword14");
                    break;
                case 14:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM SWORD RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dASPECT OF THE END\n§9»» §r§6Tap To View", 0, "textures/items/sword/aspect_of_the_end");
        $form->addButton("§l§dELUCIDATOR\n§9»» §r§6Tap To View", 0, "textures/items/sword/elucidator");
        $form->addButton("§l§dGOLEM SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/golem_sword");
        $form->addButton("§l§dLEAPING SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/leaping_sword");
        $form->addButton("§l§dMIDAS SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/midas_sword");
        $form->addButton("§l§dPOOCH SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/pooch_sword");
        $form->addButton("§l§dROGUE SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/rogue_sword");
        $form->addButton("§l§dSHAMAN SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/shaman_sword");
        $form->addButton("§l§dSILVER FANG\n§9»» §r§6Tap To View", 0, "textures/items/sword/silver_fang");
        $form->addButton("§l§dSPIRIT SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/spirit_sword");
        $form->addButton("§l§dTACTICIAN SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/tactician_sword");
        $form->addButton("§l§dTHICK TACTICIAN SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/thick_tactician_sword");
        $form->addButton("§l§dYETI SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/yeti_sword");
        $form->addButton("§l§dZOMBIE SWORD\n§9»» §r§6Tap To View", 0, "textures/items/sword/zombie_sword");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function axe(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe1");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe2");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe3");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe4");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe5");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view axe6");
                    break;
                case 6:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM AXE RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dFROZEN SCYTHE\n§9»» §r§6Tap To View", 0, "textures/items/axe/frozen_scythe");
        $form->addButton("§l§dJUNGLE AXE\n§9»» §r§6Tap To View", 0, "textures/items/axe/jungle_axe");
        $form->addButton("§l§dMUSHROOM AXE\n§9»» §r§6Tap To View", 0, "textures/items/axe/mushroom_cow_axe");
        $form->addButton("§l§dPROMISING AXE\n§9»» §r§6Tap To View", 0, "textures/items/axe/promising_axe");
        $form->addButton("§l§dRAIDER AXE\n§9»» §r§6Tap To View", 0, "textures/items/axe/raider_axe");
        $form->addButton("§l§dSCULPTOR AXE\n§9»» §r§6Tap To View", 0, "textures/items/axe/sculptor_axe");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function hoe(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view hoe1");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view hoe2");
                    break;
                case 2:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM HOE RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dHOE OF TILLING\n§9»» §r§6Tap To View", 0, "textures/items/hoe/hoe_of_tilling");
        $form->addButton("§l§dHOE OF GREATER TILLING\n§9»» §r§6Tap To View", 0, "textures/items/hoe/hoe_of_greater_tilling");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function pickaxe(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick1");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick2");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick3");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick4");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick5");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick6");
                    break;
                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick7");
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view pick8");
                    break;
                case 8:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM PICKAXE RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dPICKAXE BOULDER\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeBoulder");
        $form->addButton("§l§dPICKAXE DOLPHIN\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeDolphin");
        $form->addButton("§l§dPICKAXE DRAGON\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeDragon");
        $form->addButton("§l§dPICKAXE ERUPTION\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeEruption");
        $form->addButton("§l§dPICKAXE FLAME\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeFlame");
        $form->addButton("§l§dPICKAXE JACKPOT\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeJackpot");
        $form->addButton("§l§dPICKAXE LAVA\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/PickaxeLava");
        $form->addButton("§l§dREDSTONE PICKAXE\n§9»» §r§6Tap To View", 0, "textures/items/pickaxe/redstone_pickaxe");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function items(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item1");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item3");
                    break;

                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item4");
                    break;

                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item5");
                    break;

                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view item6");
                    break;

                case 6:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM ITEMS RECIPES");
        $form->setContent("§bSelect The Which Item Recipe You Want:");
        $form->addButton("§l§dDRAGON'S BREATH\n§9»» §r§6Tap To View", 0, "textures/items/dragons_breath");
        $form->addButton("§l§dINFINITE WATER\n§9»» §r§6Tap To Get", 0, "textures/items/bucket_water");
        $form->addButton("§l§dINFINITE LAVA\n§9»» §r§6Tap To Get", 0, "textures/items/bucket_lava");
        $form->addButton("§l§dPIGGY BANK\n§9»» §r§6Tap To Get", 0, "textures/items/other/piggy_bank");
        $form->addButton("§l§dBAG\n§9»» §r§6Tap To Get", 0, "textures/items/other/bag");
        $form->addButton("§l§dPROFILE\n§9»» §r§6Tap To Get", 0, "textures/items/other/Passport");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    
    public function wand(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    $sender->sendTitle("§r§l§eCOMMING SOON");
                    break;

                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view wand2");
                    break;

                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view wand3");
                    break;

                case 3:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6WANDS RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dBUILDER WAND\n§9»» §r§6Tap To View", 0, "textures/items/wand/builders_wand");
        $form->addButton("§l§dSELL WAND\n§9»» §r§6Tap To View", 0, "textures/items/wand/sell_wand");
        $form->addButton("§l§dSMELT WAND\n§9»» §r§6Tap To View", 0, "textures/items/wand/melt_wand");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }

    public function food(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food1");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food2");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food3");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food4");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food5");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food6");
                    break;
                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food7");
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food8");
                    break;
                case 8:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view food9");
                    break;
                case 9:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6CUSTOM FOOD RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dBURGER\n§9»» §r§6Tap To View", 0, "textures/items/food/burger");
        $form->addButton("§l§dCHRISTMAS PUDDING\n§9»» §r§6Tap To View", 0, "textures/items/food/christmas_pudding");
        $form->addButton("§l§dHOTDOG\n§9»» §r§6Tap To View", 0, "textures/items/food/hotdog");
        $form->addButton("§l§dICE CREAME\n§9»» §r§6Tap To View", 0, "textures/items/food/ice-cream");
        $form->addButton("§l§dKFC CHICKEN\n§9»» §r§6Tap To View", 0, "textures/items/food/kfc_chicken");
        $form->addButton("§l§dLOLIPOP\n§9»» §r§6Tap To View", 0, "textures/items/food/lolipop");
        $form->addButton("§l§dPIZZA\n§9»» §r§6Tap To View", 0, "textures/items/food/pizza");
        $form->addButton("§l§dSANDWICH\n§9»» §r§6Tap To View", 0, "textures/items/food/sandwich");
        $form->addButton("§l§dCUP CAKE\n§9»» §r§6Tap To View", 0, "textures/items/food/yellowcupcake");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
    public function runes(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune1");
                    break;
                    
                case 1:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune2");
                    break;
                    
                case 2:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune3");
                    break;
                    
                case 3:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune4");
                    break;
                    
                case 4:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune5");
                    break;
                    
                case 5:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune6");
                    break;
                    
                case 6:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune7");
                    break;
                    
                case 7:
                    Server::getInstance()->dispatchCommand($sender, "invcraft view rune8");
                    break;

                case 8:
                    $sender->sendForm(new RecipesForm());
                    break;
            }
        });
        $form->setTitle("§l§6RUNES RECIPES");
        $form->setContent("§bSelect The Recipe You Want To Craft:");
        $form->addButton("§l§dHOT RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/hot_rune");
        $form->addButton("§l§dICE RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/ice_rune");
        $form->addButton("§l§dLAVA RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/lava_rune");
        $form->addButton("§l§dHEART RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/hearts_rune");
        $form->addButton("§l§dRAINBOW RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/rainbow_rune");
        $form->addButton("§l§dZAP RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/zap_rune");
        $form->addButton("§l§dGOLDEN RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/golden_rune");
        $form->addButton("§l§dSNOW RUNE\n§9»» §r§6Tap To View", 0, "textures/items/runes/snow_rune");
        $form->addButton("§l§aBACK\n§9»» §r§bTap To Go Back", 0, "textures/ui/icon_import");
        $sender->sendForm($form);
        return $form;
    }
}
