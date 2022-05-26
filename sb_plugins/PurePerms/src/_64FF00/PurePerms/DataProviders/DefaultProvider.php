<?php

namespace _64FF00\PurePerms\DataProviders;

use RuntimeException;
use pocketmine\utils\Config;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;

class DefaultProvider implements ProviderInterface
{
    private PurePerms $plugin;

    private Config $groups;
    private Config $players; 

    /**
     * @param PurePerms $plugin
     */
    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;
        $this->plugin->saveResource("ranks.yml");

        $this->groups = new Config($this->plugin->getDataFolder() . "ranks.yml", Config::YAML);
        if ($this->groups->getAll() === []) {
            throw new RuntimeException($this->plugin->getMessage("logger_messages.YAMLProvider_InvalidGroupsSettings"));
        }

        $this->plugin->saveResource("players.yml");
        $this->players = new Config($this->plugin->getDataFolder() . "players.yml", Config::YAML);
    }

    public function getGroupData(PPGroup $group): mixed
    {
        $groupName = $group->getName();
        if (!isset($this->getGroupsData()[$groupName]) || !is_array($this->getGroupsData()[$groupName])) {
            return [];
        }

        return $this->getGroupsData()[$groupName];
    }

    public function getGroupsConfig(): mixed
    {
        return $this->groups;
    }

    public function getGroupsData(): mixed
    {
        return $this->groups->getAll();
    }

    public function getPlayerData(IPlayer $player): array
    {
        $userName = strtolower($player->getName());
        if (!$this->players->exists($userName)) {
            return [
                "group" => $this->plugin->getDefaultGroup()->getName(),
                "permissions" => [],
                "worlds" => [],
                "time" => -1
            ];
        }

        return $this->players->get($userName);
    }

    public function getUsers(): void
    {
        /*
        if(empty($this->players->getAll()))
            return null;

        return $this->players->getAll();
        */
    }

    public function setGroupData(PPGroup $group, array $tempGroupData): void
    {
        $groupName = $group->getName();

        $this->groups->set($groupName, $tempGroupData);
        $this->groups->save();
    }

    public function setGroupsData(array $tempGroupsData): void
    {
        $this->groups->setAll($tempGroupsData);
        $this->groups->save();
    }

    public function setPlayerData(IPlayer $player, array $tempUserData): void
    {
        $userName = strtolower($player->getName());
        if (!$this->players->exists($userName)) {
            $this->players->set($userName, [
                "group" => $this->plugin->getDefaultGroup()->getName(),
                "permissions" => [],
                "worlds" => [],
                "time" => -1
            ]);
        }

        if (isset($tempUserData["userName"])) {
            unset($tempUserData["userName"]);
        }
        $this->players->set($userName, $tempUserData);
        $this->players->save();
    }

    public function close(): void
    {
    }
}
