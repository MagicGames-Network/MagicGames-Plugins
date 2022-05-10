<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use Pushkar\MagicCore\Main;
use jojoe77777\FormAPI\Form;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\console\ConsoleCommandSender;
use Pushkar\MagicCore\forms\RankshopForm;

class RankshopForm extends MenuForm
{
    public function __construct()
    {
        parent::__construct("is_dynamic&side_text§e» RANKSHOP «", "§bHi, §bWelcome To The Ranks Shop\n\n§aWelcome To The Server\n§eMagic§6Games\n\n§aThere Are Several Ranks Available On Our Server, Namely:", [
            new MenuOption("grid_tile§fMEMBER", new FormIcon("https://i.imgur.com/2b7iNjx.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§eVOTER", new FormIcon("https://i.imgur.com/s6mntJZ.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§aVIP", new FormIcon("https://i.imgur.com/NTLdDOO.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§aVIP§c+", new FormIcon("https://i.imgur.com/7ekMbwD.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§bMVP", new FormIcon("https://i.imgur.com/iyw0IVB.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§bMVP§c+", new FormIcon("https://i.imgur.com/0QweNSQ.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§bMVP§e+§c+", new FormIcon("https://i.imgur.com/93Fuqj5.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§cYOUTUBE", new FormIcon("https://i.imgur.com/HYNd0I3.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->member($sender);
                    break;
                case 1:
                    $this->vote($sender);
                    break;
                case 2:
                    $this->vip($sender);
                    break;
                case 3:
                    $this->vipplus($sender);
                    break;
                case 4:
                    $this->mvp($sender);
                    break;
                case 5:
                    $this->mvpplus($sender);
                    break;
                case 6:
                    $this->mvpplusplus($sender);
                    break;
                case 7:
                    $this->youtube($sender);
                    break;
                case 8:
                    break;
            }
        });
    }
    
    public function member(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMEMBER§6«");
        $form->setContent(Main::getInstance()->getConfig()->get("member.feature"));
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function vote(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aVOTER§6«");
        $form->setContent(Main::getInstance()->getConfig()->get("voter.feature"));
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function vip(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendMessage(" §eRankShop Will Be Opened When Server Will Release");
                    #$this->vipbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aVIP§6«");
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("vip.cost"), Main::getInstance()->getConfig()->get("vip.feature")));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Main::getInstance()->getConfig()->get("vip.cost"), 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function vipplus(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendMessage(" §eRankShop Will Be Opened When Server Will Release");
                    #$this->vipplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aVIP§c+§6«");
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("vip+.cost"), Main::getInstance()->getConfig()->get("vip+.feature")));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Main::getInstance()->getConfig()->get("vip+.cost"), 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function mvp(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendMessage(" §eRankShop Will Be Opened When Server Will Release");
                    #$this->mvpbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§6«");
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp.cost"), Main::getInstance()->getConfig()->get("mvp.feature")));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Main::getInstance()->getConfig()->get("mvp.cost"), 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function mvpplus(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendMessage(" §eRankShop Will Be Opened When Server Will Release");
                    #$this->mvpplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§c+§6«");
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp+.cost"), Main::getInstance()->getConfig()->get("mvp+.feature")));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Main::getInstance()->getConfig()->get("mvp+.cost"), 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function mvpplusplus(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendMessage(" §eRankShop Will Be Opened When Server Will Release");
                    #$this->mvpplusplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§e+§c+§6«");
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp++.cost"), Main::getInstance()->getConfig()->get("mvp++.feature")));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Main::getInstance()->getConfig()->get("mvp++.cost"), 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    public function youtube(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§cYOUTUBE§6«");
        $form->setContent(Main::getInstance()->getConfig()->get("youtube.feature"));
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
   
  /*███╗░░░███╗░█████╗░░██████╗░██╗░█████╗░░██████╗░░█████╗░███╗░░░███╗███████╗░██████╗
    ████╗░████║██╔══██╗██╔════╝░██║██╔══██╗██╔════╝░██╔══██╗████╗░████║██╔════╝██╔════╝
    ██╔████╔██║███████║██║░░██╗░██║██║░░╚═╝██║░░██╗░███████║██╔████╔██║█████╗░░╚█████╗░
    ██║╚██╔╝██║██╔══██║██║░░╚██╗██║██║░░██╗██║░░╚██╗██╔══██║██║╚██╔╝██║██╔══╝░░░╚═══██╗
    ██║░╚═╝░██║██║░░██║╚██████╔╝██║╚█████╔╝╚██████╔╝██║░░██║██║░╚═╝░██║███████╗██████╔╝
    ╚═╝░░░░░╚═╝╚═╝░░╚═╝░╚═════╝░╚═╝░╚════╝░░╚═════╝░╚═╝░░╚═╝╚═╝░░░░░╚═╝╚══════╝╚═════╝░ */
    public function vipbuy(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                  $coins = EconomyAPI::getInstance()->myMoney($sender);
                    $name = $sender->getName();
                    $rank = Main::getInstance()->getConfig()->get("vip.name");
                    $cost = Main::getInstance()->getConfig()->get("vip.cost");
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), Main::getInstance()->getConfig()->get("vip.cmd")));
                        $sender->sendMessage(Main::getInstance()->getConfig()->get("vip.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed VIP Rank");
                        return true;
                    } else {
                        $sender->sendMessage(Main::getInstance()->getConfig()->get("vip.error"));
                    }
                  break;
                case 1:
                  $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                  break;
            }
        });
        $form->setTitle(Main::getInstance()->getConfig()->get("vip.title"));
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("vip.cost"), Main::getInstance()->getConfig()->get("vip.buy")));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }
    public function vipplusbuy(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                  $coins = EconomyAPI::getInstance()->myMoney($sender);
                    $name = $sender->getName();
                    $rank = Main::getInstance()->getConfig()->get("vip+.name");
                    $cost = Main::getInstance()->getConfig()->get("vip+.cost");
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), Main::getInstance()->getConfig()->get("vip+.cmd")));

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("vip+.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed §aVIP§c+ §aRank");
                        return true;
                    } else {
                        $sender->sendMessage(Main::getInstance()->getConfig()->get("vip+.error"));
                    }
                  break;
                case 1:
                  $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                  break;
            }
        });
        $form->setTitle(Main::getInstance()->getConfig()->get("vip+.title"));
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("vip+.cost"), Main::getInstance()->getConfig()->get("vip+.buy")));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }
    public function mvpbuy(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                  $coins = EconomyAPI::getInstance()->myMoney($sender);
                    $name = $sender->getName();
                    $rank = Main::getInstance()->getConfig()->get("mvp.name");
                    $cost = Main::getInstance()->getConfig()->get("mvp.cost");
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), Main::getInstance()->getConfig()->get("mvp.cmd")));

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed §bMVP §aRank");
                        return true;
                    } else {
                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp.error"));
                    }
                  break;
                case 1:
                  $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                  break;
            }
        });
        $form->setTitle(Main::getInstance()->getConfig()->get("mvp.title"));
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp.cost"), Main::getInstance()->getConfig()->get("mvp.buy")));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }
    public function mvpplusbuy(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                  $coins = EconomyAPI::getInstance()->myMoney($sender);
                    $name = $sender->getName();
                    $rank = Main::getInstance()->getConfig()->get("mvp+.name");
                    $cost = Main::getInstance()->getConfig()->get("mvp+.cost");
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), Main::getInstance()->getConfig()->get("mvp+.cmd")));

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp+.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed §bMVP§c+§a Rank");
                        return true;
                    } else {

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp+.error"));
                    }
                  break;
                case 1:
                  $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                  break;
            }
        });
        $form->setTitle(Main::getInstance()->getConfig()->get("mvp+.title"));
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp+.cost"), Main::getInstance()->getConfig()->get("mvp+.buy")));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }
    
    public function mvpplusplusbuy(Player $sender): Form
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                  $coins = EconomyAPI::getInstance()->myMoney($sender);
                    $name = $sender->getName();
                    $rank = Main::getInstance()->getConfig()->get("mvp++.name");
                    $cost = Main::getInstance()->getConfig()->get("mvp++.cost");
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), Main::getInstance()->getConfig()->get("mvp++.cmd")));

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp++.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed §bMVP§e+§c+ §aRank");
                        return true;
                    } else {

                        $sender->sendMessage(Main::getInstance()->getConfig()->get("mvp++.error"));
                    }
                  break;
                case 1:
                  $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                  break;
            }
        });
        $form->setTitle(Main::getInstance()->getConfig()->get("mvp++.title"));
        $form->setContent(str_replace("{cost}", Main::getInstance()->getConfig()->get("mvp++.cost"), Main::getInstance()->getConfig()->get("mvp++.buy")));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }
}
