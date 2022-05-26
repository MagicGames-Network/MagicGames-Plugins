<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\FormIcon;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;
use _64FF00\PurePerms\PurePerms;
use Pushkar\MagicCore\MagicCore;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\console\ConsoleCommandSender;

class PetsForm extends MenuForm
{
    public function __construct(Player $sender)
    {
        $name = $sender->getName();
        parent::__construct("§ePETS MENU", "§bHello §e$name\n\n§bChoose your lovely pets\n§bYou can put chest on your pets and can sit on pets with saddle\n§bYour pet will attack your enemy if he hits you.", [
            new MenuOption("§bSpawn Pet\n§d§l»§r Tap to select!", new FormIcon("https://i.imgur.com/kF3wkLK.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§b30 Pet Exp\n§d§l»§r Tap to select!", new FormIcon("https://i.imgur.com/txLAYpn.png", FormIcon::IMAGE_TYPE_URL)),
            new MenuOption("§bRemove Pet\n§d§l»§r Tap to select!", new FormIcon("https://i.imgur.com/bR1tvGE.png", FormIcon::IMAGE_TYPE_URL))
        ], function (Player $sender, int $selected): void {
            switch ($selected) {
                case 0:
                    $this->spawnform($sender);
                    break;
                case 1:
                    $bits = MagicCore::getInstance()->getBitsBalance($sender->getName());
                    $name = $sender->getName();
                    if ($bits > 10) {
                        MagicCore::getInstance()->takeBitsBalance($sender->getName(), 10);
                        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), "addpetpoints \"$name\" 30 \"$name\"");
                    } else {
                        $sender->sendMessage(" §7You Need 10 bits to pets exp");
                    }
                    break;
                case 2:
                    $name = $sender->getName();
                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), "removepet \"$name\" \"$name\"");
                    break;
            }
        });
    }

    public function SpawnPet(string $pet, Player $sender, float $size = 0.5): void
    {
        $name = $sender->getName();
        Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), "spawnpet $pet $name $size false $name");
    }

    public function spawnform(Player $sender): void
    {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            if ($data === null) {
                return true;
            }

            /** @var PurePerms */
            $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
            switch ($data) {
                case 0:
                    $this->SpawnPet("Arrow", $sender);
                    break;

                case 1:
                    $this->SpawnPet("Bat", $sender);
                    break;

                case 2:
                    $this->SpawnPet("Blaze", $sender);
                    break;

                case 3:
                    $this->SpawnPet("CaveSpider", $sender);
                    break;

                case 4:
                    $this->SpawnPet("Chicken", $sender);
                    break;

                case 5:
                    $this->SpawnPet("Cow", $sender);
                    break;

                case 6:
                    $this->SpawnPet("Creeper", $sender);
                    break;

                case 7:
                    $this->SpawnPet("Donkey", $sender);
                    break;

                case 8:
                    $this->SpawnPet("ElderGuardian", $sender);
                    break;

                case 9:
                    if ($purePerms->getUserDataMgr()->getData($sender)["group"] === "Member") {
                        $this->SpawnPet("EnderDragon", $sender, 0.1);
                    }
                    break;

                case 10:
                    $this->SpawnPet("Enderman", $sender);
                    break;

                case 11:
                    $this->SpawnPet("Endermite", $sender);
                    break;

                case 12:
                    $this->SpawnPet("Evoker", $sender);
                    break;

                case 13:
                    $this->SpawnPet("Ghast", $sender);
                    break;

                case 14:
                    $this->SpawnPet("Guardian", $sender);
                    break;

                case 15:
                    $this->SpawnPet("Horse", $sender);
                    break;

                case 16:
                    $this->SpawnPet("Husk", $sender);
                    break;

                case 17:
                    $this->SpawnPet("IronGolem", $sender);
                    break;

                case 18:
                    $this->SpawnPet("Llama", $sender);
                    break;

                case 19:
                    $this->SpawnPet("MagmaCube", $sender, 1);
                    break;

                case 20:
                    $this->SpawnPet("Mooshroom", $sender);
                    break;

                case 21:
                    $this->SpawnPet("Mule", $sender);
                    break;

                case 22:
                    $this->SpawnPet("Ocelot", $sender);
                    break;

                case 23:
                    $this->SpawnPet("Pig", $sender);
                    break;

                case 24:
                    $this->SpawnPet("PolarBear", $sender);
                    break;

                case 25:
                    $this->SpawnPet("Rabbit", $sender);
                    break;

                case 26:
                    $this->SpawnPet("Sheep", $sender);
                    break;

                case 27:
                    $this->SpawnPet("Skeleton", $sender);
                    break;

                case 28:
                    $this->SpawnPet("Slime", $sender, 1);
                    break;

                case 29:
                    if ($purePerms->getUserDataMgr()->getData($sender)["group"] === "LORDPLUSPLUS") {
                        $this->SpawnPet("SnowGolem", $sender, 0.5);
                    }
                    break;

                case 30:
                    $this->SpawnPet("Spider", $sender);
                    break;

                case 31:
                    $this->SpawnPet("Squid", $sender);
                    break;

                case 32:
                    $this->SpawnPet("Vex", $sender);
                    break;

                case 33:
                    $this->SpawnPet("Villager", $sender);
                    break;

                case 34:
                    $this->SpawnPet("Witch", $sender);
                    break;

                case 35:
                    if ($purePerms->getUserDataMgr()->getData($sender)["group"] === "LORDPLUSPLUS") {
                        $this->SpawnPet("Wither", $sender, 0.2);
                    }
                    break;

                case 36:
                    $this->SpawnPet("Wolf", $sender);
                    break;

                case 37:
                    $this->SpawnPet("Zombie", $sender);
                    break;

                case 38:
                    $sender->sendForm(new PetsForm($sender));
                    break;
            }
        });
        $form->setTitle("§6»§e SPAWN PETS §6«");
        $form->addButton("§bArrow\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bBat\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bBlaze\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bCave Spider\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bChicken\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bCow\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bCreeper\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bDonkey\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bElderGuardian\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bEnderDragon\n§d§l»§r §dLORD§e+§r Rank Required", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bEnderman\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bEndermite\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bEvoker\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bGhast\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bGuardian\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bHorse\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bHusk\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bIronGolem\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bLlama\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bMagmaCube\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bMooshroom\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bMule\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bOcelot\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bPig\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bPolarBear\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bRabbit\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSheep\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSkeleton\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSlime\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSnowGolem\n§d§l»§r §dLORD§e+§r Rank Required", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSpider\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bSquid\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bVex\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bVillager\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bWitch\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bWither\n§d§l»§r §dLORD§e+§r Rank Required", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bWolf\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§bZombie\n§d§l»§r Tap to spawn!", 1, "https://i.imgur.com/6IFQDgN.png");
        $form->addButton("§cBack");
        $sender->sendForm($form);
    }
}
