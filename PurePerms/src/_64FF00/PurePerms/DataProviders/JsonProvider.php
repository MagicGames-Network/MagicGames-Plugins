<?php

namespace _64FF00\PurePerms\DataProviders;

use RuntimeException;
use pocketmine\utils\Config;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;

class JsonProvider implements ProviderInterface
{
    private PurePerms $plugin;

    private Config $groups;
    private string $userDataFolder;

    /**
     * @param PurePerms $plugin
     */
    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;
        $this->plugin->saveResource("ranks.yml");

        $this->groups = new Config($this->plugin->getDataFolder() . "ranks.yml", Config::YAML, []);
        $this->userDataFolder = $this->plugin->getDataFolder() . "players/";
        if (!file_exists($this->userDataFolder)) {
            @mkdir($this->userDataFolder, 0777, true);
        }
    }

    public function getGroupData(PPGroup $group): mixed
    {
        $groupName = $group->getName();
        if (!isset($this->getGroupsData()[$groupName]) || !is_array($this->getGroupsData()[$groupName])) {
            return [];
        }

        return $this->getGroupsData()[$groupName];
    }

    public function getGroupsConfig(): Config
    {
        return $this->groups;
    }

    public function getGroupsData(): mixed
    {
        return $this->groups->getAll();
    }

    public function getPlayerConfig(IPlayer $player, bool $onUpdate = false): array|Config
    {
        $userName = $player->getName();

        // TODO
        if ($onUpdate === true) {
            if (!file_exists($this->userDataFolder . strtolower($userName) . ".json")) {
                return new Config($this->userDataFolder . strtolower($userName) . ".json", Config::YAML, [
                    "userName" => $userName,
                    "group" => $this->plugin->getDefaultGroup()->getName(),
                    "permissions" => [],
                    "worlds" => [],
                    "time" => -1
                ]);
            } else {
                return new Config($this->userDataFolder . strtolower($userName) . ".json", Config::YAML, []);
            }
        } else {
            if (file_exists($this->userDataFolder . strtolower($userName) . ".json")) {
                return new Config($this->userDataFolder . strtolower($userName) . ".json", Config::YAML, []);
            } else {
                return [
                    "userName" => $userName,
                    "group" => $this->plugin->getDefaultGroup()->getName(),
                    "permissions" => [],
                    "worlds" => [],
                    "time" => -1
                ];
            }
        }
    }

    public function getPlayerData(IPlayer $player): array
    {
        $userConfig = $this->getPlayerConfig($player);
        if (is_array($userConfig)) {
            return [];
        }
        
        return $userConfig->getAll();
    }

    public function getUsers(): void
    {
        // TODO: Implement getUsers() method.
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
        $userData = $this->getPlayerConfig($player, true);
        if (!$userData instanceof Config) {
            throw new RuntimeException("Failed to update player data: Invalid data type returned");
        }

        $userData->setAll($tempUserData);
        $userData->save();
    }

    public function close(): void
    {
    }
}
