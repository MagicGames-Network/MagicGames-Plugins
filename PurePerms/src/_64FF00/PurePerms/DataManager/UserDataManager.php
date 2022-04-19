<?php

namespace _64FF00\PurePerms\DataManager;

use pocketmine\world\World;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;
use _64FF00\PurePerms\EventManager\PPRankChangedEvent;

class UserDataManager
{
    private PurePerms $plugin;

    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getData(IPlayer $player): array
    {
        return $this->plugin->getProvider()->getPlayerData($player);
    }

    public function getExpDate(IPlayer $player, ?string $worldName = null): mixed
    {
        $expDate = $worldName !== null ? $this->getWorldData($player, $worldName)["expTime"] : $this->getNode($player, "expTime");
        // TODO
        return $expDate;
    }

    public function getGroup(IPlayer $player, ?string $worldName = null): ?PPGroup
    {
        $groupName = $worldName !== null ? $this->getWorldData($player, $worldName)["group"] : $this->getNode($player, "group");
        $group = $this->plugin->getGroup($groupName);
        // TODO: ...
        if (!$group instanceof PPGroup) {
            $defaultGroup = $this->plugin->getDefaultGroup($worldName);

            $this->plugin->getLogger()->critical("Invalid group name found in " . $player->getName() . "'s player data (World: " . (!is_string($worldName) ? "GLOBAL" : $worldName) . ")");
            $this->plugin->getLogger()->critical("Restoring the group data to 'default'");
            $this->setGroup($player, $defaultGroup, $worldName);
            return $defaultGroup;
        }

        return $group;
    }

    public function getNode(IPlayer $player, string $node): mixed
    {
        $userData = $this->getData($player);
        if (!isset($userData[$node])) {
            return null;
        }
        return $userData[$node];
    }

    public function getUserPermissions(IPlayer $player, ?string $worldName = null): array
    {
        $permissions = $worldName != null ? $this->getWorldData($player, $worldName)["permissions"] : $this->getNode($player, "permissions");
        if (!is_array($permissions)) {
            $this->plugin->getLogger()->critical("Invalid 'permissions' node given to " . __METHOD__ . '()');
            return [];
        }
        return $permissions;
    }

    public function getWorldData(IPlayer $player, ?string $worldName = null): array
    {
        if (!is_string($worldName)) {
            $defaultWorld = $this->plugin->getServer()->getWorldManager()->getDefaultWorld();
            if (!$defaultWorld instanceof World) {
                return [];
            }

            $worldName = $defaultWorld->getFolderName();
        }

        if (!isset($this->getData($player)["worlds"][$worldName])) {
            return [
                "group" => $this->plugin->getDefaultGroup($worldName)->getName(),
                "permissions" => [],
                "expTime" => -1
            ];
        }

        return $this->getData($player)["worlds"][$worldName];
    }

    public function removeNode(IPlayer $player, string $node): void
    {
        $tempUserData = $this->getData($player);
        if (isset($tempUserData[$node])) {
            unset($tempUserData[$node]);
            $this->setData($player, $tempUserData);
        }
    }

    public function setData(IPlayer $player, array $data): void
    {
        $this->plugin->getProvider()->setPlayerData($player, $data);
    }

    public function setGroup(IPlayer $player, PPGroup $group, ?string $worldName = null, int $time = -1): void
    {
        if (!is_string($worldName)) {
            $this->setNode($player, "group", $group->getName());
            $this->setNode($player, "expTime", $time);
        } else {
            $worldData = $this->getWorldData($player, $worldName);
            $worldData["group"] = $group->getName();
            $worldData["expTime"] = $time;
            $this->setWorldData($player, $worldName, $worldData);
        }

        $event = new PPRankChangedEvent($this->plugin, $player, $group, $worldName);
        $event->call();
    }

    public function setNode(IPlayer $player, string $node, mixed $value): void
    {
        $tempUserData = $this->getData($player);
        $tempUserData[$node] = $value;

        $this->setData($player, $tempUserData);
    }

    public function setPermission(IPlayer $player, string $permission, ?string $worldName = null): void
    {
        if (!is_string($worldName)) {
            $tempUserData = $this->getData($player);
            $tempUserData["permissions"][] = $permission;
            $this->setData($player, $tempUserData);
        } else {
            $worldData = $this->getWorldData($player, $worldName);
            $worldData["permissions"][] = $permission;
            $this->setWorldData($player, $worldName, $worldData);
        }

        $this->plugin->updatePermissions($player);
    }

    public function setWorldData(IPlayer $player, string $worldName, array $worldData): void
    {
        $tempUserData = $this->getData($player);
        if (!isset($this->getData($player)["worlds"][$worldName])) {
            $tempUserData["worlds"][$worldName] = [
                "group" => $this->plugin->getDefaultGroup()->getName(),
                "permissions" => [],
                "expTime" => -1
            ];

            $this->setData($player, $tempUserData);
        }
        $tempUserData["worlds"][$worldName] = $worldData;
        $this->setData($player, $tempUserData);
    }

    public function unsetPermission(IPlayer $player, string $permission, ?string $worldName = null): void
    {
        if (!is_string($worldName)) {
            $tempUserData = $this->getData($player);
            if (!in_array($permission, $tempUserData["permissions"])) return;
            $tempUserData["permissions"] = array_diff($tempUserData["permissions"], [$permission]);
            $this->setData($player, $tempUserData);
        } else {
            $worldData = $this->getWorldData($player, $worldName);
            if (!in_array($permission, $worldData["permissions"])) return;
            $worldData["permissions"] = array_diff($worldData["permissions"], [$permission]);
            $this->setWorldData($player, $worldName, $worldData);
        }

        $this->plugin->updatePermissions($player);
    }
}
