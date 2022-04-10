<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion;

use CortexPE\Commando\PacketHooker as Commando;
use JackMD\ConfigUpdater\ConfigUpdater;
use BhawaniSingh\HCMinion\commands\MinionCommand;
use BhawaniSingh\HCMinion\entities\objects\Farmland;
use BhawaniSingh\HCMinion\entities\types\FarmingMinion;
use BhawaniSingh\HCMinion\entities\types\LumberjackMinion;
use BhawaniSingh\HCMinion\entities\types\MiningMinion;
use muqsit\invcrashfix\Loader as InvCrashFix;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\block\BlockFactory;
use pocketmine\entity\Entity;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use function class_exists;

class BetterMinion extends PluginBase
{
    use SingletonTrait;

    /** @var string[] */
    public static $minions = [MiningMinion::class, FarmingMinion::class, LumberjackMinion::class];

    /** @var string[] */
    public $isRemove = [];

    public function onLoad(): void
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->saveResource('smelts.json');
        $this->saveResource('compacts.json');
    }

    public function onEnable(): void
    {
        foreach ([InvMenu::class, ConfigUpdater::class, Commando::class] as $class) {
            if (!class_exists($class)) {
                $this->getLogger()->alert("{$class} not found! Please download this plugin from Poggit CI. Disabling plugin...");
                $this->getServer()->getPluginManager()->disablePlugin($this);
            }
        }
        if (!class_exists(InvCrashFix::class)) {
            $this->getLogger()->notice('InvCrashFix is required to fix client crashes on 1.16+, download it here: https://poggit.pmmp.io/ci/Muqsit/InvCrashFix');
        }
        foreach (self::$minions as $minion) {
            Entity::registerEntity($minion, true);
        }
        BlockFactory::registerBlock(new Farmland(), true);
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
        ConfigUpdater::checkUpdate($this, $this->getConfig(), 'config-version', 1);
        if (!Commando::isRegistered()) {
            Commando::register($this);
        }
        $this->getServer()->getCommandMap()->register('Minion', new MinionCommand($this, 'minion', 'MagicMinion Main Command'));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}
