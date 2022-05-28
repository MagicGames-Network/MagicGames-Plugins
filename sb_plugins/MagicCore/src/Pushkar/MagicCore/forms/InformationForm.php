<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use Stats\player\MagicPlayer;
use dktapps\pmforms\MenuOption;
use _64FF00\PurePerms\PurePerms;
use Pushkar\MagicCore\MagicCore;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use Pushkar\MagicCore\forms\RankshopForm;

class InformationForm extends MenuForm
{
    private array $players = [];

    public function __construct()
    {
        parent::__construct("§3§l«§r §bINFORMATIONS §3§l»", "§eSelect the category listed below:", [
            new MenuOption("§b§lABOUT\n§r§8Tap to check", new FormIcon("https://i.imgur.com/xbYrpSW.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§a§lCHANGELOG\n§r§8Tap to check", new FormIcon("https://i.imgur.com/UQvACCH.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§3§lFEATURES\n§r§8Tap to check", new FormIcon("https://i.imgur.com/RDDn4S8.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§c§lRULES\n§r§8Tap to check", new FormIcon("https://i.imgur.com/nVQ64qx.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§5§lSTAFF-LIST\n§r§8Tap to check", new FormIcon("https://i.imgur.com/2VRM6BT.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§6§lTUTORIAL\n§r§8Tap to check", new FormIcon("https://i.imgur.com/9u10Avf.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§1§lRANK-LIST\n§r§8Tap to check", new FormIcon("https://i.imgur.com/gICdeHW.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§9§lSOCIAL-MEDIA\n§r§8Tap to check", new FormIcon("https://i.imgur.com/2jjvcKo.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§6§lANNOUNCEMENTS\n§r§8Tap to check", new FormIcon("https://i.imgur.com/XNl95R5.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§5§lEVENT\n§r§8Tap to check", new FormIcon("https://i.imgur.com/erHwlje.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $player, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->INFOONE($player);
                    break;
                case 1:
                    $this->INFOTWO($player);
                    break;
                case 2:
                    $this->INFOTHREE($player);
                    break;
                case 3:
                    $this->INFOFOR($player);
                    break;
                case 4:
                    $this->INFOFIVE($player);
                    break;
                case 5:
                    $this->INFOSIX($player);
                    break;
                case 6:
                    $player->sendForm(new RankshopForm());
                    break;
                case 7:
                    $this->INFOEIGHT($player);
                    break;
                case 8:
                    $this->INFONINE($player);
                    break;
                case 9:
                    $this->INFOTEN($player);
                    break;
            }
        });
    }

    public function INFOONE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§b§lABOUT §r§8(( MagicGames))");
        $form->setContent("§bHey you, do you know §eMagic§6Games§b? Let me introduce it to you!\n§eMagic§6Games§b is a Minecraft: Bedrock Edition Server With Skyblock, Survival and Minigames!\n\n§bAbove you can find:\n§b- Survival\n§b- Minigames\n§b- Skyblock\n§b- Do Adventure With Your Friends\n§b- Fair Gameplay\n§b- Voting Crate, Get Keys Through Voting\n§b- Get Ranks And Perks\n§b- Buy Ranks With Ingame Money\n§b- No Pay To Win\n\n§bYou now have enough to get as much happiness as possible\n§bSo I convinced you? §bJoin us quickly!\n\n§eDiscord: https://discord.gg/32xh5mqe7F\n§eVote: https://bitly.com/vote-magic\n\n§eServer Ip: play.magicgamesmc.net\n§ePort: 19132\n\n§bTo support us:\n§bVote Our Server\n§bAnd Dont Forget To Join Our Discord Too!");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOTWO(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§a§lCHANGELOG §r§8(( MagicGames ))");
        $form->setContent(":)");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOTHREE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§3§lFEATURES\n§r§8Tap to check");
        $form->setContent("§aThis server is nice ;)!");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOFOR(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§c§lRULES §r§8(( MagicGames ))");
        $form->setContent("§cTreat others with respect.\n§cHacking is not tolerated.\n§cOffensive content is not allowed.\n§cKeep chat family friendly.\n§cAdvertising is not allowed.\n§cSpamming is not allowed.");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOFIVE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§5§lSTAFF-LIST");
        $form->setContent(":)");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOSIX(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
                default:
                    $this->INFOSIX($player);
                    break;
            }
        });
        $form->setTitle("§6§lTUTORIAL");
        $form->setContent("§eSelect the tutorial listed down below:");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $form->addButton("§6§lTUTORIAL §a#1\n§r§8Tap to check", 0, "textures/ui/icon_crafting");
        $form->addButton("§6§lTUTORIAL §a#2\n§r§8Tap to check", 0, "textures/ui/icon_crafting");
        $form->addButton("§6§lTUTORIAL §a#3\n§r§8Tap to check", 0, "textures/ui/icon_crafting");
        $form->addButton("§6§lTUTORIAL §a#4\n§r§8Tap to check", 0, "textures/ui/icon_crafting");
        $form->addButton("§6§lTUTORIAL §a#5\n§r§8Tap to check", 0, "textures/ui/icon_crafting");
        $player->sendForm($form);
    }

    public function RLONE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§eVIP");
        $form->setContent("§aVIP Rank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/cape\n\n§cBonus\n§a» PlayerVaults 1-2\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e300k OwO\n§a» §e$1");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function RLTWO(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§eVIP §a+");
        $form->setContent("§aVIP§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n\n§cBonus\n§a» PlayerVaults 1-4\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP§c+§aKIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e400k OwO\n§a» §e$2");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function RLTHREE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§bMVP");
        $form->setContent("§bMVP §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/vision\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n\n§cBonus\n§a» PlayerVaults 1-6\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To MEMBER KIT\n§a» Access To §bVIP+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e600k OwO\n§a» §e$3");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function RLFOR(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§bMVP §c+");
        $form->setContent("§bMVP§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/vision\n§a» §e/skin\n§a» §e/say\n§a» §e/god\n§a» §e/size\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To §bMVP§c+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e800k OwO\n§a» §e$4");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function RLFIVE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§bMVP §c++");
        $form->setContent("§bMVP§e+§c+ §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n§a» §e/god\n§a» §e/size\n§a» §e/repair\n§a» §e/tp\n§a» §e/nick\n§a» §e/vision\n§a» §e/speed\n§a» §e/pets\n§a» §e/vanish\n\n§cBonus\n§a» PlayerVaults 1-10\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To MVP KIT\n§a» Access To MVP+ KIT\n§a» Access To §bMVP§e+§c+§a KIT\n\n§aWant To Buy Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.io/magicgames\n\n§ePrice\n§a» §e1M OwO\n§a» §e$5");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function RLSIX(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOSEVEN($player);
                    break;
            }
        });
        $form->setTitle("§cYOUTUBE");
        $form->setContent("§cYOUTUBE §aRank Features §eMagic§6Games\n§a» §e/fly\n§a» §e/heal\n§a» §e/feed\n§a» §e/feed\n§a» §e/cape\n§a» §e/me\n§a» §e/skin\n§a» §e/say\n§a» §e/vanish\n§a» §e/vision\n§a» §e/pets\n§a» §e/repair\n\n§cBonus\n§a» PlayerVaults 1-8\n§a» Access To MEMBER KIT\n§a» Access To VIP KIT\n§a» Access To VIP+ KIT\n§a» Access To §cYOUTUBE§a KIT\n\n§d» Special Joining Message\n\n§aWant To Get This Rank?\n§aJoin In Discord And Make Ticket\n§a» §bhttps://discord.gg/magicgames\n\n§eRequirement:\n§a» §e300subs\n§a» §eMust Make 1 Video On Server");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOSEVEN(Player $sender): void
    {
        $form = new SimpleForm(function (Player $sender, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $sender->sendForm(new InformationForm());
                    break;
                case 2:
                    $this->RLONE($sender);
                    break;
                case 3:
                    $this->RLTWO($sender);
                    break;
                case 4:
                    $this->RLTHREE($sender);
                    break;
                case 5:
                    $this->RLFOR($sender);
                    break;
                case 6:
                    $this->RLFIVE($sender);
                    break;
                case 7:
                    $this->RLSIX($sender);
                    break;
            }
        });
        $form->setTitle("§1§lRANK-LIST");
        $form->setContent("§cSelect the rank below:");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $form->addButton("§eVIP\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $form->addButton("§eVIP§a+\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $form->addButton("§bMVP\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $form->addButton("§bMVP§c+\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $form->addButton("§bMVP§c++\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $form->addButton("§cYOUTUBE\n§r§8Tap to check", 0, "textures/ui/icon_deals");
        $sender->sendForm($form);
    }

    public function INFOEIGHT(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
                case 2:
                    $this->SMONE($player);
                    break;
                case 3:
                    $this->SMTWO($player);
                    break;
                case 4:
                    $this->SMTHREE($player);
                    break;
                case 5:
                    $this->SMFOR($player);
                    break;
                case 6:
                    $this->SMFIVE($player);
                    break;
            }
        });
        $form->setTitle("§9§lSOCIAL MEDIA");
        $form->setContent("§aMagicGames Social Media");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $form->addButton("§1§lDISCORD\n§r§8Tap to check", 0, "textures/ui/book_cover");
        $form->addButton("§b§lTWITTER\n§r§8Tap to check", 0, "textures/ui/book_cover");
        $form->addButton("§a§lWEBSITE\n§r§8Tap to check", 0, "textures/ui/book_cover");
        $form->addButton("§d§lINSTAGRAM\n§r§8Tap to check", 0, "textures/ui/book_cover");
        $form->addButton("§4§lYOUTUBE\n§r§8Tap to check", 0, "textures/ui/book_cover");
        $player->sendForm($form);
    }

    public function SMONE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOEIGHT($player);
                    break;
            }
        });
        $form->setTitle("§1§lDISCORD");
        $form->setContent("https://discord.gg/32xh5mqe7F");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function SMTWO(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOEIGHT($player);
                    break;
            }
        });
        $form->setTitle("§b§lTWITTER");
        $form->setContent("");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function SMTHREE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOEIGHT($player);
                    break;
            }
        });
        $form->setTitle("§a§lWEBSITE");
        $form->setContent("§7§oCOMMING SOON");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function SMFOR(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOEIGHT($player);
                    break;
            }
        });
        $form->setTitle("§d§lINSTAGRAM");
        $form->setContent("");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function SMFIVE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $this->INFOEIGHT($player);
                    break;
            }
        });
        $form->setTitle("§4§lYOUTUBE");
        $form->setContent("§bhttps://tinyurl.com/magic-games-yt");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFONINE(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§6§lANNOUNCEMENT §r§8(( MagicGames ))");
        $form->setContent("§eNo Announcement Today!");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function INFOTEN(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
                case 1:
                    $player->sendForm(new InformationForm());
                    break;
            }
        });
        $form->setTitle("§5§lEVENT §r§8(( MagicGames ))");
        $form->setContent("§5§lEVENT LIST:\n§r§bEvent: §r\n§7No Event Today!");
        $form->addButton("§c§lEXIT\n§r§8Tap to exit", 0, "textures/ui/cancel");
        $form->addButton("§6§lBACK\n§r§8Tap to go back", 0, "textures/ui/icon_import");
        $player->sendForm($form);
    }

    public function comingsoon(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    $player->sendMessage("\n§8§lCOMING SOON!\n§r§7Pushkar will add more features to this plugin just be patient because this plugin is still not §a100%§7 perfect\n");
                    $player->sendTitle("§8§lCOMING SOON!", "§cMore features will be added!");
                    break;
            }
        });
        $form->setTitle("§8§lCOMING SOON");
        $form->setContent("§c§lWARNING!\n§r§7you are not allowed to eSM-BTN-ONEdit this message on the config also u cant edit this page!\n\n§b§lINFO:\n§r§7report any bug/error to ItzFabn the creator of this plugin also please apologize if this plugin still bugging/error...");
        $form->addButton("§8§lCOMING SOON\n§r§8Tap for more info");
        $player->sendForm($form);
    }

    public function emojis(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    break;
            }
        });
        $form->setTitle("§l§bEMOJIS");
        $form->setContent("§dHello §e" . $player->getName() . "\n§dWelcome To MagicGames Emojis\n§dAvailability: §aFree For All Right Now\n\n§b:sword: = \n\n§b:skull: = \n\n§b:earth: = \n\n§b:portal: = \n\n§b:dice: = \n\n§b:candy: = \n\n§b:crown: = \n\n§b:star: = \n\n§b:diamond: \n\n§b:bruh: = \n\n§b:hehe: = \n\n§b:ooo: = \n\n§b:cry: = \n\n§b:stare: = \n\n§b:happy: = \n\n§b:angry: = \n\n§b:hmm: = \n\n§b:sus: = ");
        $form->addButton("§l§cEXIT\n§l§9»» §r§oTap To Exit", 1, "https://cdn-icons-png.flaticon.com/128/929/929416.png");
        $player->sendForm($form);
    }

    public function profile(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($player, "skills");
                    break;
                case 1:
                    break;
            }
        });
        /** @var PurePerms $purePerms */
        $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
        $item = $player->getInventory()->getItemInHand();
        $damage = ($player instanceof MagicPlayer ? $player->getDamage() : 0) + $item->getAttackPoints();
        $defense = ($player instanceof MagicPlayer ? $player->getDefense() : 0) + $player->getArmorPoints();
        $heal = $player->getHealth();
        $maxheal = $player->getMaxHealth();
        $form->setTitle("§l§bPROFILE");
        $form->setContent("§dHello §e" . $player->getName() . "\n\n§dWelcome To MagicGames Profile, Here You Can See Your Profile And Stats\n\n§bName: §a" . $player->getName() . "\n§bRank: §a" . $purePerms->getUserDataMgr()->getData($player)["group"] . "\n§bMoney: §a" . EconomyAPI::getInstance()->myMoney($player) . "\n§bPing: §a" . $player->getNetworkSession()->getPing() . "\n§bPosition: §a" . (int) $player->getPosition()->getX() . " " . (int) $player->getPosition()->getY() . " " . (int) $player->getPosition()->getZ() . "\n§bWorld: §a" . $player->getWorld()->getFolderName() . "\n§bHealth: §a" . (int) $player->getHealth() . "§a/" . $player->getMaxHealth() . "\n\n§d§lSTATS:§r\n\n§cHealth: $heal" . "§7/§c$maxheal \n\n§aDefense: §a$defense \n\n§4Damage: $damage ");
        $form->addButton("§l§bYOUR SKILLS\n§l§9»» §r§oTap To Open", 1, "https://cdn-icons-png.flaticon.com/128/2091/2091418.png");
        $form->addButton("§l§cEXIT\n§l§9»» §r§oTap To Exit", 1, "https://cdn-icons-png.flaticon.com/128/2698/2698776.png");
        $player->sendForm($form);
    }

    public function skin(Player $players): void
    {
        $list = [];
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $list[] = $player->getName();
        }
        $this->players[$players->getName()] = $list;
        $form = new CustomForm(function (Player $players, array $data = null) {
            if ($data === null) {
                return;
            }

            $dataSelected = Server::getInstance()->getPlayerExact($this->players[$players->getName()][$data[1]]);
            if (!$dataSelected instanceof Player) {
                return;
            }

            $otherSkin = $dataSelected->getSkin();
            $players->sendMessage(" §7You Stole §e{$dataSelected->getName()} §7Skin!");
            $players->setSkin($otherSkin);
            $players->sendSkin();
            $players->despawnFromAll();
            $players->spawnToAll();

            unset($this->players[$players->getName()]);
        });
        $form->setTitle("§3§lSKIN STEALER");
        $form->addLabel("§bSelect Player Skin");
        $form->addDropdown("", $this->players[$players->getName()]);
        $players->sendForm($form);
    }
}
