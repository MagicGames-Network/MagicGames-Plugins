<?php

namespace Quest;

use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use Quest\listener\QuestListener;
use Quest\providers\SQLiteProvider;

class Quest extends PluginBase
{
    private static Quest $instance;

    private SQLiteProvider $provider;
    private Config $quest;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        $this->saveResource("quest.yml");

        $this->provider = new SQLiteProvider();
        $this->quest = new Config($this->getDataFolder() . "quest.yml", Config::YAML);

        $this->getServer()->getPluginManager()->registerEvents(new QuestListener(), $this);
    }

    public function getProvider(): SQLiteProvider
    {
        return $this->provider;
    }

    public static function getInstance(): Quest
    {
        return self::$instance;
    }

    public function getQuest(): Config
    {
        return $this->quest;
    }
}
