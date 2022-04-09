<?php

namespace Pushkar\MagicCore\menu;

use pocketmine\Server;
use Pushkar\MagicCore\Main;
use pocketmine\player\Player;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\console\ConsoleCommandSender;

class Rankshop
{
    private Main $plugin;
    private ?EconomyAPI $eco;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
        $this->eco = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI"); /** @phpstan-ignore-line */
    }

    public function rankshop($sender)
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
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
        $form->setTitle("§l§2RANK SHOP MAGICGAMES");
        $form->setContent("§bHi, §bWelcome To The Ranks Shop\n\n§aWelcome To The Server\n§eMagic§6Games\n\n§aThere Are Several Ranks Available On Our Server, Namely:");
        $form->addButton("§6» §2MEMBER §6«\n§8Click To See", 0, "textures/icon/member");
        $form->addButton("§6» §2VOTER §6«\n§8Click To See", 0, "textures/icon/vote");
        $form->addButton("§6» §2VIP §6«\n§8Click To Buy", 0, "textures/icon/vip");
        $form->addButton("§6» §2VIP§c+ §6«\n§8Click To Buy", 0, "textures/icon/vip+");
        $form->addButton("§6» §2MVP §6«\n§8Click To Buy", 0, "textures/icon/mvp");
        $form->addButton("§6» §2MVP§c+ §6«\n§8Click To Buy", 0, "textures/icon/mvp+");
        $form->addButton("§6» §2MVP§e+§c+ §6«\n§8Click To Buy", 0, "textures/icon/mvp++");
        $form->addButton("§6» §cYOUTUBE §6«\n§8Click To See", 0, "textures/icon/youtube");
        $form->addButton("§cExit", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function member($sender)
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2MEMBER§6«");
        $form->setContent("§aMEMBER Rank Features §eMagic§6Games\n§a» §e/cape\n\n§cBonus\n§a» PlayerVaults 1\n§a» Access To MEMBER KIT\n\n§aThis Is A Default Rank");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function vote($sender)
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2VOTER§6«");
        $form->setContent("§aVOTER Rank Features §eMagic§6Games\n§a» §e/cape\n§a» §e/heal\n§a» §e/feed\n§a» §e/fly\n\n§cBonus\n§a» You Will Get 3x Vote Keys\n§a» PlayerVaults 1\n§a» You Will Get §b$10000§r\n§a» Access To MEMBER KIT\n\n§aWant To Get This Rank?\n§aVote Us On Mcpe Website\n§a» §bhttps://bitly.com/mg-vote");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function vip($sender)
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
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2VIP§6«");
        $form->setContent("§aVIP Rank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/cape\n\n§cBonus\n§a» PlayerVaults 1-2\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e300k OwO\n§a» §e$1");
        $form->addButton("§5» Buy With Ingame Money «\n§2$3000000", 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function vipplus($sender)
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
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2VIP§c+§6«");
        $form->setContent("§aVIP§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n\n§cBonus\n§a» PlayerVaults 1-4\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP§c+§aKIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e400k OwO\n§a» §e$2");
        $form->addButton("§5» Buy With Ingame Money «\n§2$6000000", 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function mvp($sender)
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
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2MVP§6«");
        $form->setContent("§bMVP §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/vision\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n\n§cBonus\n§a» PlayerVaults 1-6\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To MEMBER KIT\n§a» Access To §bVIP+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e600k OwO\n§a» §e$3");
        $form->addButton("§5» Buy With Ingame Money «\n§2$9000000", 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function mvpplus($sender)
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
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2MVP§c+§6«");
        $form->setContent("§bMVP§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/vision\n§a» §e/skin\n§a» §e/say\n§a» §e/god\n§a» §e/size\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To §bMVP§c+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e800k OwO\n§a» §e$4");
        $form->addButton("§5» Buy With Ingame Money «\n§2$12000000", 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function mvpplusplus($sender)
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
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§2MVP§e+§c+§6«");
        $form->setContent("§bMVP§e+§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n§a» §e/god\n§a» §e/size\n§a» §e/repair\n§a» §e/tp\n§a» §e/nick\n§a» §e/vision\n§a» §e/speed\n§a» §e/pets\n§a» §e/vanish\n\n§cBonus\n§a» PlayerVaults 1-10\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To MVP+ KIT\n§a» Access To §bMVP§e+§c+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e1M OwO\n§a» §e$5");
        $form->addButton("§5» Buy With Ingame Money «\n§2$14000000", 0, "textures/icon/rankstore");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function youtube($sender)
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->rankshop($sender);
                    break;
            }
        });
        $form->setTitle("§6»§4YOUTUBE§6«");
        $form->setContent("§cYOUTUBE §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n§a» §e/vanish\n§a» §e/vision\n§a» §e/pets\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To §cYOUTUBE§a KIT\n\n§aWant To Get This Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§eRequirement:\n§a» §e300subs\n§a» §eMust Make 1 Video On Server");
        $form->addButton("§cBack", 0, "textures/blocks/barrier");
        $sender->sendForm($form);
        return $form;
    }
    
    public function vipbuy($sender)
    {
        $form = new ModalForm(function (Player $sender, bool $result) {
            if ($result == null) {
            }
            switch ($result) {
                case 1:
                    $coins = $this->eco->myMoney($sender);
                    $name = $sender->getName();
                    $rank = $this->plugin->getConfig()->get("vip.name");
                    $cost = $this->plugin->getConfig()->get("vip.cost");
                    if ($coins >= $cost) {
                        $this->eco->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("vip.cmd")));
                        $sender->sendMessage($this->plugin->getConfig()->get("vip.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed $rank Rank");
                        return true;
                    } else {

                        $sender->sendMessage($this->plugin->getConfig()->get("vip.error"));
                    }
                    break;
                case 2:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $feature = $this->plugin->getConfig()->get("vip.feature");
        $form->setTitle($this->plugin->getConfig()->get("vip.title"));
        $form->setContent($feature);
        $form->setButton1("§6»Yes«");
        $form->setButton2("§c»Cancel«");
        $sender->sendForm($form);
    }
    
    public function vipplusbuy($sender)
    {
        $form = new ModalForm(function (Player $sender, bool $result) {
            if ($result == null) {
            }
            switch ($result) {
                case 1:
                    $coins = $this->eco->myMoney($sender);
                    $name = $sender->getName();
                    $rank = $this->plugin->getConfig()->get("vip+.name");
                    $cost = $this->plugin->getConfig()->get("vip+.cost");
                    if ($coins >= $cost) {
                        $this->eco->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("vip+.cmd")));

                        $sender->sendMessage($this->plugin->getConfig()->get("vip+.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed $rank Rank");
                        return true;
                    } else {

                        $sender->sendMessage($this->plugin->getConfig()->get("vip+.error"));
                    }
                    break;
                case 2:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $feature = $this->plugin->getConfig()->get("vip+.feature");
        $form->setTitle($this->plugin->getConfig()->get("vip+.title"));
        $form->setContent($feature);
        $form->setButton1("§6»Yes«");
        $form->setButton2("§c»Cancel«");
        $sender->sendForm($form);
    }
    
    public function mvpbuy($sender)
    {
        $form = new ModalForm(function (Player $sender, bool $result) {
            if ($result == null) {
            }
            switch ($result) {
                case 1:
                    $coins = $this->eco->myMoney($sender);
                    $name = $sender->getName();
                    $rank = $this->plugin->getConfig()->get("mvp.name");
                    $cost = $this->plugin->getConfig()->get("mvp.cost");
                    if ($coins >= $cost) {
                        $this->eco->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("mvp.cmd")));

                        $sender->sendMessage($this->plugin->getConfig()->get("mvp.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed $rank Rank");
                        return true;
                    } else {

                        $sender->sendMessage($this->plugin->getConfig()->get("mvp.error"));
                    }
                    break;
                case 2:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $feature = $this->plugin->getConfig()->get("mvp.feature");
        $form->setTitle($this->plugin->getConfig()->get("mvp.title"));
        $form->setContent($feature);
        $form->setButton1("§6»Yes«");
        $form->setButton2("§c»Cancel«");
        $sender->sendForm($form);
    }
    
    public function mvpplusbuy($sender)
    {
        $form = new ModalForm(function (Player $sender, bool $result) {
            if ($result == null) {
            }
            switch ($result) {
                case 1:
                    $coins = $this->eco->myMoney($sender);
                    $name = $sender->getName();
                    $rank = $this->plugin->getConfig()->get("mvp+.name");
                    $cost = $this->plugin->getConfig()->get("mvp+.cost");
                    if ($coins >= $cost) {
                        $this->eco->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("mvp+.cmd")));

                        $sender->sendMessage($this->plugin->getConfig()->get("mvp+.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed $rank Rank");
                        return true;
                    } else {

                        $sender->sendMessage($this->plugin->getConfig()->get("mvp+.error"));
                    }
                    break;
                case 2:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $feature = $this->plugin->getConfig()->get("mvp+.feature");
        $form->setTitle($this->plugin->getConfig()->get("mvp+.title"));
        $form->setContent($feature);
        $form->setButton1("§6»Yes«");
        $form->setButton2("§c»Cancel«");
        $sender->sendForm($form);
    }
    
    public function mvpplusplusbuy($sender)
    {
        $form = new ModalForm(function (Player $sender, bool $result) {
            if ($result == null) {
            }
            switch ($result) {
                case 1:
                    $coins = $this->eco->myMoney($sender);
                    $name = $sender->getName();
                    $rank = $this->plugin->getConfig()->get("mvp++.name");
                    $cost = $this->plugin->getConfig()->get("mvp++.cost");
                    if ($coins >= $cost) {
                        $this->eco->reduceMoney($sender, $cost);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), str_replace("{player}", $sender->getName(), $this->plugin->getConfig()->get("mvp++.cmd")));
                        $sender->sendMessage($this->plugin->getConfig()->get("mvp++.complete"));
                        Server::getInstance()->broadcastMessage("§f[§eMagic§6Games§f] §a$name Has Buyed $rank Rank");
                        return true;
                    } else {
                        $sender->sendMessage($this->plugin->getConfig()->get("mvp++.error"));
                    }
                    break;
                case 2:
                    $sender->sendMessage("§f[§eMagic§6Games§f]§a You Cancelled Buying The Rank");
                    break;
            }
        });
        $feature = $this->plugin->getConfig()->get("mvp++.feature");
        $form->setTitle($this->plugin->getConfig()->get("mvp++.title"));
        $form->setContent($feature);
        $form->setButton1("§6»Yes«");
        $form->setButton2("§c»Cancel«");
        $sender->sendForm($form);
    }
}
