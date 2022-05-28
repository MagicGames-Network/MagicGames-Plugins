<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use jojoe77777\FormAPI\Form;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use Pushkar\MagicCore\MagicCore;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use Pushkar\MagicCore\utils\Configuration;
use pocketmine\console\ConsoleCommandSender;

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
            new MenuOption("grid_tile§cYOUTUBE", new FormIcon("https://i.imgur.com/HYNd0I3.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§dLORD", new FormIcon("https://i.imgur.com/ieDLusZ.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("grid_tile§dLORD§e+", new FormIcon("https://i.imgur.com/IuF4m8w.png", FormIcon::IMAGE_TYPE_URL))
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
                    $this->lord($sender);
                    break;
                case 9:
                    $this->lordplus($sender);
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
        $form->setContent("§aMEMBER Rank Features §eMagic§6Games\n\n§cBonus\n§a» PlayerVaults 1\n§a» Access To MEMBER KIT\n\n§aThis Is A Default Rank");
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
        $form->setContent("§aVOTER Rank Features §eMagic§6Games\n§a» §e/heal\n§a» §e/feed\n\n§cBonus\n§a» You Will Get 3x Vote Keys\n§a» PlayerVaults 1\n§a» You Will Get §b$10000§r\n§a» Access To MEMBER KIT\n\n§aWant To Get This Rank?\n§aVote Us On Mcpe Website\n§a» §bhttps://bitly.com/mg-vote");
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
                    $this->vipbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aVIP§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::VIP_COST, "§aVIP Rank Features §eMagic§6Games\n§a» §e/heal\n§a» §e/feed\n§a» §e/cape\n§a» §e/craft\n\n§cBonus\n§a» PlayerVaults 1-2\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n\n§l§ePRICE: §e$2\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io"));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Configuration::VIP_COST, 1, "https://i.imgur.com/MYro8RD.png");
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
                    $this->vipplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aVIP§c+§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::VIP_PLUS_COST, "§aVIP§c+ §aRank Features §eMagic§6Games\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n\n§cBonus\n§a» PlayerVaults 1-4\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP§c+§aKIT\n\n§l§ePRICE: §e$3\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io"));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Configuration::VIP_PLUS_COST, 1, "https://i.imgur.com/MYro8RD.png");
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
                    $this->mvpbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_COST, "§bMVP §aRank Features §eMagic§6Games\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n§a» §e/size\n§a» §e/speed\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-6\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To MEMBER KIT\n§a» Access To §bVIP+§a KIT\n\n§l§ePRICE: §e$5\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io" ));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Configuration::MVP_COST, 1, "https://i.imgur.com/MYro8RD.png");
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
                    $this->mvpplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§c+§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_PLUS_COST, "§bMVP§c+ §aRank Features §eMagic§6Games\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n§a» §e/size\n§a» §e/skin\n§a» §e/speed\n§a» §e/vision\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To §bMVP§c+§a KIT\n\n§l§ePRICE: §e$8\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io" ));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Configuration::MVP_PLUS_COST, 1, "https://i.imgur.com/MYro8RD.png");
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
                    $this->mvpplusplusbuy($sender);
                    break;
                case 1:
                    $sender->sendForm(new RankshopForm());
                    break;
            }
        });
        $form->setTitle("§6»§aMVP§e+§c+§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_PLUS_PLUS_COST, "§bMVP§e+§c+ §aRank Features §eMagic§6Games\n§a» §e/pets\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n§a» §e/size\n§a» §e/speed\n§a» §e/vision\n§a» §e/repair\n§a» §e/skin\n\n§cBonus\n§a» PlayerVaults 1-10\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To MVP+ KIT\n§a» Access To §bMVP§e+§c+§a KIT\n\n§l§ePRICE: §e$10\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io"));
        $form->addButton("§5» Buy With Ingame Money «\n§a$" . Configuration::MVP_PLUS_PLUS_COST, 1, "https://i.imgur.com/MYro8RD.png");
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
        $form->setContent("§cYOUTUBE §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n§a» §e/vanish\n§a» §e/vision\n§a» §e/pets\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To §cYOUTUBE§a KIT\n\n§aWant To Get This Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§eRequirement:\n§a» §e500subs\n§a» §eMust Make 1 Video On Server");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }

    
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
                    $cost = Configuration::VIP_COST;
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), "temprank set \"{player}\" VIP 30d"));
                        $sender->sendMessage("§f[§eMagic§6Games§f] §aSuccess, You Successfully Purchased VIP Rank!");
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Bought VIP Rank");
                        return true;
                    } else {
                        $sender->sendMessage("§f[§eMagic§6Games§f] §cFailed, You Don't Have Enough Money To Buy VIP Rank!");
                    }
                    break;
                case 1:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $form->setTitle("VIP");
        $form->setContent(str_replace("{cost}", (string) Configuration::VIP_COST, "§bWould You Like To Purchase §aVIP Rank\n\n§bPrice » §e{cost}"));
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
                    $cost = Configuration::VIP_PLUS_COST;
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), "temprank set \"{player}\" VIPPLUS 30d"));

                        $sender->sendMessage("§f[§eMagic§6Games§f] §aSuccess, You Successfully Purchased VIP+ Rank!");
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Bought §aVIP§c+ §aRank");
                        return true;
                    } else {
                        $sender->sendMessage("§f[§eMagic§6Games§f] §cFailed, You Don't Have Enough Money To Buy VIP+ Rank!");
                    }
                    break;
                case 1:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $form->setTitle("§6»§2VIP§c+§6«");
        $form->setContent(str_replace("{cost}", (string) Configuration::VIP_PLUS_COST, "§bWould You Like To Purchase §aVIP§c+ Rank\n\n§bPrice » §e{cost}"));
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
                    $cost = Configuration::MVP_COST;
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), "temprank set \"{player}\" MVP 30d"));

                        $sender->sendMessage("§f[§eMagic§6Games§f] §aSuccess, You Successfully Purchased mvp Rank!");
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Bought §bMVP §aRank");
                        return true;
                    } else {
                        $sender->sendMessage("§f[§eMagic§6Games§f] §cFailed, You Don't Have Enough Money To Buy mvp Rank!");
                    }
                    break;
                case 1:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $form->setTitle("MVP");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_COST, "§bWould You Like To Purchase §bMVP Rank\n\n§bPrice » §e{cost}"));
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
                    $cost = Configuration::MVP_PLUS_COST;
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), "temprank set \"{player}\" MVPPLUS 30d"));

                        $sender->sendMessage("§f[§eMagic§6Games§f] §aSuccess, You Successfully Purchased mvp+ Rank!");
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Bought §bMVP§c+§a Rank");
                        return true;
                    } else {

                        $sender->sendMessage("§f[§eMagic§6Games§f] §cFailed, You Don't Have Enough Money To Buy mvp+ Rank!");
                    }
                    break;
                case 1:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $form->setTitle("Mvp+");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_PLUS_COST, "§bWould You Like To Purchase §bMVP§c+ Rank\n\n§bPrice » §e{cost}"));
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
                    $cost = Configuration::MVP_PLUS_PLUS_COST;
                    if ($coins >= $cost) {
                        EconomyAPI::getInstance()->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), "temprank set \"{player}\" MVPPLUSPLUS 30d"));

                        $sender->sendMessage("§f[§eMagic§6Games§f] §aSuccess, You Successfully Purchased mvp++ Rank!");
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Bought §bMVP§e+§c+ §aRank");
                        return true;
                    } else {

                        $sender->sendMessage("§f[§eMagic§6Games§f] §cFailed, You Don't Have Enough Money To Buy mvp++ Rank!");
                    }
                    break;
                case 1:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $form->setTitle("Mvp++");
        $form->setContent(str_replace("{cost}", (string) Configuration::MVP_PLUS_PLUS_COST, "§bWould You Like To Purchase §bMVP§e+§c+ Rank\n\n§bPrice » §e{cost}"));
        $form->addButton("§3» Yes «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572255.png");
        $form->addButton("§4» Cancel «", 1, "https://cdn-icons-png.flaticon.com/128/3572/3572260.png");
        $sender->sendForm($form);
        return $form;
    }

    public function lord(Player $sender): void
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
        $form->setTitle("§dlord");
        $form->setContent("§dLord §aRank Features §eMagic§6Games\n§a» §e/pets\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n§a» §e/size\n§a» §e/speed\n§a» §e/vision\n§a» §e/repair\n§a» §e/skin\n§a» §e/fly\n§a» §e/vanish\n§a» §e/sit\n\n§cBonus\n§a» PlayerVaults 1-12\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To MVP+ KIT\n§a» Access To §bMVP§e+§c+§a KIT\n§a» Access To LORD Kit\n\n§d» Special Joining Message\n§d» No chat cooldown\n§d» Daily Rewards Half Cooldown\n\n§l§ePRICE: §e$13\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
    }

    public function lordplus(Player $sender): void
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
        $form->setTitle("§dlord+");
        $form->setContent("§dLord+ §aRank Features §eMagic§6Games\n§a» §e/pets\n§a» §e/heal\n§a» §e/feed\n§a» §e/craft\n§a» §e/cape\n§a» §e/emoji\n§a» §e/size\n§a» §e/speed\n§a» §e/vision\n§a» §e/repair\n§a» §e/skin\n§a» §e/fly\n§a» §e/vanish\n§a» §e/god\n§a» §e/lay\n§a» §e/sit\n\n§cBonus\n§a» PlayerVaults 1-14\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To MVP+ KIT\n§a» Access To §bMVP§e+§c+§a KIT\n§a» Access To LORD Kit\n§a» Access To LORD+ Kit\n\n§d» Special Joining Message\n§d» No chat cooldown\n§d» Daily Rewards Half Cooldown\n§d» EnderDragon Pet Unlock\n§d» Wither Pet Unlock\n\n§l§ePRICE: §e$15\n§r§aWant To Buy Rank?\n§aVisit https://magicgames.tebex.io");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
    }
}
