<?php

namespace Pushkar\MagicCore\forms;

use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\world\Position;

class LiftUiForm extends MenuForm
{

    public function __construct()
    {
        parent::__construct("§l§eMagic Skyblock Lift Operator","§6Please Select The Cave You Want To Telport",[
            new MenuOption("§3Iron Mine\n§9»» §r§oTap to Teleport", new FormIcon("textures/items/iron_ingot", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Gold Mine\n§9»» §r§oTap to Teleport", new FormIcon("textures/items/gold_ingot", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Redstone Mine\n§9»» §r§o§cMining 2 Required", new FormIcon("textures/items/redstone_dust", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Lapis Mine\n§9»» §r§o§cMining 2 Required", new FormIcon("textures/items/dye_powder_blue", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Emerald Mine\n§9»» §r§o§cMining 3 Required", new FormIcon("textures/items/emerald", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Diamond Mine\n§9»» §r§o§cMining 3 Required", new FormIcon("textures/items/diamond", FormIcon::IMAGE_TYPE_PATH)),
            new MenuOption("§3Santuary\n§9»» §r§o§cMining 4 Required", new FormIcon("textures/blocks/obsidian", FormIcon::IMAGE_TYPE_PATH))
        ], function (Player $sender, int $selected): void{
            switch ($selected){
                case 0:
                 $world = $this->plugin->getConfig()->get("iron-world");
                 $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("iron-x")), floatval($this->plugin->getConfig()->get("iron-y")), floatval($this->plugin->getConfig()->get("iron-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                 $sender->sendTitle("§lIRON MINE");
                   break;
                  
                  case 1:
                 $world = $this->plugin->getConfig()->get("gold-world");
                 $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("gold-x")), floatval($this->plugin->getConfig()->get("gold-y")), floatval($this->plugin->getConfig()->get("gold-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                 $sender->sendTitle("§6§lGOLD MINE");
                   break;
                  
                  case 2:
                  if($sender->hasPermission("lift.lapis")){
                   $world = $this->plugin->getConfig()->get("redstone-world");
                   $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("redstone-x")), floatval($this->plugin->getConfig()->get("redstone-y")), floatval($this->plugin->getConfig()->get("redstone-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                   $sender->sendTitle("§c§lREDSTONE MINE");
                    } else {
                      $sender->sendMessage ("§e§lMAGICGAMES > §r§cMining Level 2 Required, §bDo /skills To Check Your Level");
                    }
                   break;
          
                  case 3:
                    if($sender->hasPermission("lift.lapis")){
                     $world = $this->plugin->getConfig()->get("lapis-world");
                     $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("lapis-x")), floatval($this->plugin->getConfig()->get("lapis-y")), floatval($this->plugin->getConfig()->get("lapis-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                      $sender->sendTitle("§9§lLAPIS MINE");
                   } else {
                      $sender->sendMessage ("§e§lMAGICGAMES > §r§cMining Level 2 Required, §bDo /skills To Check Your Level");
                    }                  
                   break;
                  
                  case 4:
                    if($sender->hasPermission("lift.diamond")){
                     $world = $this->plugin->getConfig()->get("emerald-world");
                     $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("emerald-x")), floatval($this->plugin->getConfig()->get("emerald-y")), floatval($this->plugin->getConfig()->get("emerald-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                      $sender->sendTitle("§a§lEMERALD MINE");
                    } else {
                      $sender->sendMessage ("§e§lMAGICGAMES > §r§cMining Level 3 Required, §bDo /skills To Check Your Level");
                    }
                   break;
                  
                  case 5:
                   if($sender->hasPermission("lift.diamond")){
                     $world = $this->plugin->getConfig()->get("diamond-world");
                     $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("diamond-x")), floatval($this->plugin->getConfig()->get("diamond-y")), floatval($this->plugin->getConfig()->get("diamond-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                       $sender->sendTitle("§l§bDIAMOND MINE");
                   } else {
                      $sender->sendMessage ("§e§lMAGICGAMES > §r§cMining Level 3 Required, §bDo /skills To Check Your Level");
                    }
                   break;
                  
                  case 6:
                  if($sender->hasPermission("lift.obsidian")){  
                     $world = $this->plugin->getConfig()->get("obsidian-world");
                     $sender->teleport(new Position(floatval($this->plugin->getConfig()->get("obsidian-x")), floatval($this->plugin->getConfig()->get("obsidian-y")), floatval($this->plugin->getConfig()->get("obsidian-z")), $this->plugin->getServer()->getWorldManager()->getWorldByName($world)));
                       $sender->sendTitle("§e§lSANTUARY");
                  } else {
                      $sender->sendMessage ("§e§lMAGICGAMES > §r§cMining Level 4 Required, §bDo /skills To Check Your Level");
                    }
                   break;
            }
        });
    }

}