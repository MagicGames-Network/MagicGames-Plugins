<?php

namespace Pushkar\MagicCore\menu;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\Server;
use Pushkar\MagicCore\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\Form;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\FormAPI;

class InformationForm extends MenuForm
{
  
	private Main $plugin;
	
	public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
        $config = new Config($this->plugin->getDataFolder() . "Config.yml", Config::YAML);
    }
    
  public function MainMenu ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOONE($sender);
                     
			      
                 break;
                 case 2;
                     $this->INFOTWO($sender);
                     
				 
                 break;
                 case 3;
                     $this->INFOTHREE($sender);
                     
				 
                 break;
                 case 4;
                     $this->INFOFOR($sender);
                     
				 
                 break;
                 case 5;
                     $this->INFOFIVE($sender);
                     
				 
                 break;
                 case 6;
                     $this->INFOSIX($sender);
                     
				 
                 break;
                 case 7;
                     $this->INFOSEVEN($sender);
                     
			 	 
                 break;
                 case 8;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;
                 case 9;
                     $this->INFONINE($sender);
                     
				 
                 break;
                 case 10;
                     $this->INFOTEN($sender);
                     
				 
                 break;
                 case 11;
                     $this->comingsoon($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-MENU"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-MENU"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-ONE"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-TWO"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-THREE"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-FOR"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-FIVE"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-SIX"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-SEVEN"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-EIGHT"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-NINE"), 0, "textures/ui/copy");
      	$form->addButton($this->plugin->getConfig()->get("INFO-BTN-TEN"), 0, "textures/ui/copy");
      	$form->addButton("§0§lCOMING SOON\n§r§cMORE FEATURES CMNG SOON!", 0, "textures/blocks/barrier");
      	$form->sendToPlayer($sender);
	}
	public function INFOONE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0:
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-ABOUT"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-ABOUT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOTWO ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-CHANGELOG"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-CHANGELOG"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
     	$form->sendToPlayer($sender);
	}
	public function INFOTHREE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-FEATURES"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-FEATURES"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOFOR ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
			 	 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-RULES"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-RULES"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOFIVE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-STAFFLIST"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-STAFFLIST"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOSIX ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                      $this->MainMenu($sender);
                      
				  
                  break;
                  case 2;
                     $this->TutorialONE($sender);
                     
				 
                  break;
                  case 3;
                     $this->TutorialTWO($sender);
                     
				 
                  break;
                  case 4;
                     $this->TutorialTHREE($sender);
                     
				 
                  break;
                  case 5;
                     $this->TutorialFOR($sender);
                     
				 
                  break;
                  case 6;
                     $this->TutorialFIVE($sender);
                     
				 
                  break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-TITLE-MENU"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-CONTENT-MENU"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->addButton($this->plugin->getConfig()->get("TUTORIAL-ONE-BTN"), 0, "textures/ui/icon_crafting");
      	$form->addButton($this->plugin->getConfig()->get("TUTORIAL-TWO-BTN"), 0, "textures/ui/icon_crafting");
      	$form->addButton($this->plugin->getConfig()->get("TUTORIAL-THREE-BTN"), 0, "textures/ui/icon_crafting");
      	$form->addButton($this->plugin->getConfig()->get("TUTORIAL-FOR-BTN"), 0, "textures/ui/icon_crafting");
      	$form->addButton($this->plugin->getConfig()->get("TUTORIAL-FIVE-BTN"), 0, "textures/ui/icon_crafting");
      	$form->sendToPlayer($sender);
	}
	public function TutorialONE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-ONE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-ONE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function TutorialTWO ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-TWO-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-TWO-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function TutorialTHREE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-THREE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-THREE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function TutorialFOR ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-FOR-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-FOR-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function TutorialFIVE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TUTORIAL-FIVE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("TUTORIAL-FIVE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOSEVEN ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
                 case 2;
                     $this->RLONE($sender);
                     
				 
                 break;
                 case 3;
                     $this->RLTWO($sender);
                     
				 
                 break;
                 case 4;
                     $this->RLTHREE($sender);
                     
				 
                 break;
                 case 5;
                     $this->RLFOR($sender);
                     
				 
                 break;
                 case 6;
                     $this->RLFIVE($sender);
                     
				 
                 break;
                 case 7;
                     $this->RLSIX($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-TITLE-MENU"));
      	$form->setContent($this->plugin->getConfig()->get("RL-CONTENT-MENU"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-ONE"), 0, "textures/ui/icon_deals");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-TWO"), 0, "textures/ui/icon_deals");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-THREE"), 0, "textures/ui/icon_deals");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-FOR"), 0, "textures/ui/icon_deals");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-FIVE"), 0, "textures/ui/icon_deals");
      	$form->addButton($this->plugin->getConfig()->get("RL-BTN-SIX"), 0, "textures/ui/icon_deals");
      	$form->sendToPlayer($sender);
	}
	public function RLONE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-ONE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-ONE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function RLTWO ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-TWO-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-TWO-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function RLTHREE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-THREE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-THREE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function RLFOR ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-FOR-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-FOR-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function RLFIVE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-FIVE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-FIVE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function RLSIX ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOSEVEN($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("RL-SIX-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("RL-SIX-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOEIGHT ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
                 case 2;
                     $this->SMONE($sender);
                     
				 
                 break;
                 case 3;
                     $this->SMTWO($sender);
                     
				 
                 break;
                 case 4;
                     $this->SMTHREE($sender);
                     
				 
                 break;
                 case 5;
                     $this->SMFOR($sender);
                     
				 
                 break;
                 case 6;
                     $this->SMFIVE($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-TITLE-MENU"));
      	$form->setContent($this->plugin->getConfig()->get("SM-CONTENT-MENU"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->addButton($this->plugin->getConfig()->get("SM-BTN-ONE"), 0, "textures/ui/book_cover");
      	$form->addButton($this->plugin->getConfig()->get("SM-BTN-TWO"), 0, "textures/ui/book_cover");
      	$form->addButton($this->plugin->getConfig()->get("SM-BTN-THREE"), 0, "textures/ui/book_cover");
      	$form->addButton($this->plugin->getConfig()->get("SM-BTN-FOR"), 0, "textures/ui/book_cover");
      	$form->addButton($this->plugin->getConfig()->get("SM-BTN-FIVE"), 0, "textures/ui/book_cover");
      	$form->sendToPlayer($sender);
	}
	public function SMONE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-ONE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("SM-ONE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function SMTWO ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-TWO-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("SM-TWO-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function SMTHREE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-THREE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("SM-THREE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function SMFOR ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-FOR-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("SM-FOR-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function SMFIVE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->INFOEIGHT($sender);
                     
				 
                 break;               
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("SM-FIVE-TITLE"));
      	$form->setContent($this->plugin->getConfig()->get("SM-FIVE-CONTENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFONINE ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-ANNOUNCEMENT"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-ANNOUNCEMENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function INFOTEN ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                 break;
                 case 1;
                     $this->MainMenu($sender);
                     
				 
                 break;
            }
      	});
      	$form->setTitle($this->plugin->getConfig()->get("TITLE-EVENT"));
      	$form->setContent($this->plugin->getConfig()->get("CONTENT-EVENT"));
      	$form->addButton($this->plugin->getConfig()->get("EXIT-BTN"), 0, "textures/ui/cancel");
      	$form->addButton($this->plugin->getConfig()->get("BACK-BTN"), 0, "textures/ui/icon_import");
      	$form->sendToPlayer($sender);
	}
	public function comingsoon ($sender){
         $form = new SimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                 case 0;
                     $sender->sendMessage("\n§8§lCOMING SOON!\n§r§7Pushkar will add more features to this plugin just be patient because this plugin is still not §a100%§7 perfect\n");
                     $sender->sendTitle("§8§lCOMING SOON!", "§cMore features will be added!");

                 break;
            }
      	});
      	$form->setTitle("§8§lCOMING SOON");
      	$form->setContent("§c§lWARNING!\n§r§7you are not allowed to eSM-BTN-ONEdit this message on the config also u cant edit this page!\n\n§b§lINFO:\n§r§7report any bug/error to ItzFabn the creator of this plugin also please apologize if this plugin still bugging/error...");
      	$form->addButton("§8§lCOMING SOON\n§r§8Tap for more info");
      	$form->sendToPlayer($sender);
      	return true;
	}
}