<?php

namespace Quest;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Quest\listener\QuestListener;
use Quest\providers\SQLiteProvider;

class Quest extends PluginBase
{

    private SQLiteProvider $provider;

    private static Quest $instance;

    private Config $quest;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new QuestListener(),$this);

        $this->provider = new SQLiteProvider();

        $this->saveResource("quest.yml");

        $this->quest = new Config($this->getDataFolder()."quest.yml",Config::YAML);
    }

    /**
     * @return SQLiteProvider
     */
    public function getProvider(): SQLiteProvider
    {
        return $this->provider;
    }

    /**
     * @return Quest
     */
    public static function getInstance(): Quest
    {
        return self::$instance;
    }

    /**
     * @return Config
     */
    public function getQuest(): Config
    {
        return $this->quest;
    }
}