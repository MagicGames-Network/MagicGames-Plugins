<?php

namespace blueturk\skyblock;

use blueturk\skyblock\listener\IslandListener;
use blueturk\skyblock\managers\CommandManager;
use JsonException;
use pocketmine\{utils\Config};
use pocketmine\plugin\PluginBase;

class SkyBlock extends PluginBase
{

    /**
     * @var SkyBlock
     */
    protected static SkyBlock $api;

    /**
     * @var string
     */
    public const BT_TITLE = "§l§dSKYBLOCK§r §l§a»§r §5";

    public static array $weathers = [];
    /**
     * @var string
     */
    public const BT_MARK = "§d» §";

    public function onEnable(): void
    {
        self::$api = $this;
        CommandManager::loadCommands();
        self::$api->getServer()->getPluginManager()->registerEvents(new IslandListener(), self::$api);
        $this->getLogger()->notice(sprintf("%s commands loaded!", CommandManager::commandsCount()));
    }

    /**
     * @throws JsonException
     */
    public function onDisable():void
    {
        self::$api->saveConfig();
    }

    /**
     * @return mixed
     */
    public static function getInstance(): SkyBlock
    {
        return self::$api;
    }
}