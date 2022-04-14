<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags;

use cosmicnebula200\MagicTags\listeners\EventListener;
use cosmicnebula200\MagicTags\commands\TagCommand;
use cosmicnebula200\MagicTags\players\PlayerManager;
use cosmicnebula200\MagicTags\queries\Queries;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class MagicTags extends PluginBase
{

    /**@var self*/
    private static self $instance;
    /**@var DataConnector*/
    private DataConnector $database;
    /**@var PlayerManager*/
    private PlayerManager $playerManager;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->initDB();
        $this->playerManager = new PlayerManager();
        $this->saveResource('tags.yml');
        $this->saveResource('messages.yml');
        $this->getServer()->getCommandMap()->register('MagicTags', new TagCommand($this, "tag", "The tag command for MagicGames"));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    public function initDB()
    {
        $db = libasynql::create($this, $this->getConfig()->get("database"), ["sqlite" => "sqlite.sql", "mysql" => "mysql.sql"]);
        $db->executeGeneric(Queries::CREATE_DB);
        $this->database = $db;
    }

    public function formatMessage(string $message, array $tags): string
    {
        $messages = $this->getMessages()->getAll();
        $msg = $messages["messages"][$message];
        foreach ($tags as $key => $value)
        {
            $msg = str_replace("{" . $key . "}", $value, $msg);
        }
        return TextFormat::colorize($messages["prefix"] . " " .  $msg);
    }

    public function getDatabase(): DataConnector
    {
        return $this->database;
    }

    public function getMessages(): Config
    {
        return new Config($this->getDataFolder() . 'messages.yml', Config::YAML);
    }

    public function getTags(): array
    {
        $tags = new Config($this->getDataFolder() . 'tags.yml', Config::YAML);
        return $tags->getAll();
    }

    public function getPlayerManager(): PlayerManager
    {
        return $this->playerManager;
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}
