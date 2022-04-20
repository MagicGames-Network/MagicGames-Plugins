<?php

namespace _64FF00\PurePerms;

class PPGroup
{
    private PurePerms $plugin;

    private string $name;
    private array $parents = [];

    public function __construct(PurePerms $plugin, string $name)
    {
        $this->plugin = $plugin;
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function addParent(PPGroup $group): bool
    {
        $tempGroupData = $this->getData();
        if ($this === $group || in_array($this->getName(), $group->getParentGroups())) {
            return false;
        }

        $tempGroupData["inheritance"][] = $group->getName();
        $this->setData($tempGroupData);
        $this->plugin->updatePlayersInGroup($this);
        return true;
    }

    public function createWorldData(string $worldName): void
    {
        if (!isset($this->getData()["worlds"][$worldName])) {
            $tempGroupData = $this->getData();

            $tempGroupData["worlds"][$worldName] = [
                "isDefault" => false,
                "permissions" => []
            ];
            $this->setData($tempGroupData);
        }
    }

    public function getAlias(): mixed
    {
        if ($this->getNode("alias") === null) {
            return $this->name;
        }
        return $this->getNode("alias");
    }

    public function getData(): mixed
    {
        return $this->plugin->getProvider()->getGroupData($this);
    }

    public function getGroupPermissions(?string $worldName = null): array
    {
        $permissions = [];
        $worldPermissions = [];

        $permissions = $this->getNode("permissions");
        if (is_string($worldName)) {
            $worldData = $this->getWorldData($worldName);
            if (isset($worldData["permissions"])) {
                $worldPermissions = $worldData["permissions"];
            }
        }
        if (!is_array($permissions)) {
            $this->plugin->getLogger()->critical("Invalid 'permissions' node given to " .  __METHOD__);
            return [];
        }

        foreach ($this->getParentGroups() as $parentGroup) {
            $parentPermissions = $parentGroup->getGroupPermissions($worldName);

            // Fixed by @mad-hon (https://github.com/mad-hon) / Tysm! :D
            $permissions = array_merge($parentPermissions, $permissions, $worldPermissions);
        }
        return $permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNode(string $node): mixed
    {
        if (!isset($this->getData()[$node])) return null;
        return $this->getData()[$node];
    }

    /**
     * @return PPGroup[]
     */
    public function getParentGroups(): array
    {
        if ($this->parents === []) {
            if (!is_array($this->getNode("inheritance"))) {
                $this->plugin->getLogger()->critical("Invalid 'inheritance' node given to " . __METHOD__);
                return [];
            }

            foreach ($this->getNode("inheritance") as $parentGroupName) {
                $parentGroup = $this->plugin->getGroup($parentGroupName);
                if ($parentGroup !== null) {
                    $this->parents[] = $parentGroup;
                }
            }
        }
        return $this->parents;
    }

    public function getWorldData(string $worldName): ?array
    {
        //return $this->getData()["worlds"][$worldName];

        // too lazy to fix this
        return [
            "isDefault" => false,
            "permissions" => []
        ];
    }

    public function getWorldNode(string $worldName, string $node): ?bool
    {
        $worldData = $this->getWorldData($worldName);
        if (!is_array($worldData)) {
            return null;
        }
        return $worldData[$node];
    }

    public function isDefault(?string $worldName = null): bool
    {
        if (!is_string($worldName)) {
            return $this->getNode("isDefault");
        } else {
            $worldData = $this->getWorldData($worldName);
            if (!is_array($worldData)) {
                return false;
            }

            return $worldData["isDefault"];
        }
    }

    public function removeNode(string $node): void
    {
        $tempGroupData = $this->getData();
        if (isset($tempGroupData[$node])) {
            unset($tempGroupData[$node]);

            $this->setData($tempGroupData);
        }
    }

    public function removeParent(PPGroup $group): bool
    {
        $tempGroupData = $this->getData();
        $tempGroupData["inheritance"] = array_diff($tempGroupData["inheritance"], [$group->getName()]);

        $this->setData($tempGroupData);
        $this->plugin->updatePlayersInGroup($this);
        return true;
    }

    public function removeWorldNode(string $worldName, string $node): void
    {
        $worldData = $this->getWorldData($worldName);
        if (isset($worldData[$node])) {
            unset($worldData[$node]);
            $this->setWorldData($worldName, $worldData);
        }
    }

    public function setData(array $data): void
    {
        $this->plugin->getProvider()->setGroupData($this, $data);
    }

    public function setDefault(?string $worldName = null): void
    {
        if (!is_string($worldName)) {
            $this->setNode("isDefault", true);
        } else {
            $worldData = $this->getWorldData($worldName);
            $worldData["isDefault"] = true;
            $this->setWorldData($worldName, $worldData);
        }
    }

    public function setGroupPermission(string $permission, ?string $worldName = null): bool
    {
        if ($worldName == null) {
            $tempGroupData = $this->getData();
            $tempGroupData["permissions"][] = $permission;
            $this->setData($tempGroupData);
        } else {
            $worldData = $this->getWorldData($worldName);
            $worldData["permissions"][] = $permission;
            $this->setWorldData($worldName, $worldData);
        }
        $this->plugin->updatePlayersInGroup($this);
        return true;
    }

    public function setNode(string $node, mixed $value): void
    {
        $tempGroupData = $this->getData();
        $tempGroupData[$node] = $value;

        $this->setData($tempGroupData);
    }

    public function setWorldData(string $worldName, array $worldData): void
    {
        if (isset($this->getData()["worlds"][$worldName])) {
            $tempGroupData = $this->getData();
            $tempGroupData["worlds"][$worldName] = $worldData;
            $this->setData($tempGroupData);
        }
    }

    public function setWorldNode(string $worldName, string $node, mixed $value): void
    {
        $worldData = $this->getWorldData($worldName);
        $worldData[$node] = $value;
        $this->setWorldData($worldName, $worldData);
    }

    public function sortPermissions(): void
    {
        $tempGroupData = $this->getData();
        if (isset($tempGroupData["permissions"])) {
            $tempGroupData["permissions"] = array_unique($tempGroupData["permissions"]);
            sort($tempGroupData["permissions"]);
        }

        /** @phpstan-ignore-next-line */
        if ($this->plugin->getConfigValue("enable-multiworld-perms") && isset($tempGroupData["worlds"])) {
            foreach ($this->plugin->getServer()->getWorldManager()->getWorlds() as $world) {
                $worldName = $world->getFolderName();
                if (isset($tempGroupData["worlds"][$worldName])) {
                    $tempGroupData["worlds"][$worldName]["permissions"] = array_unique($tempGroupData["worlds"][$worldName]["permissions"]);
                    sort($tempGroupData["worlds"][$worldName]["permissions"]);
                }
            }
        }
        $this->setData($tempGroupData);
    }

    public function unsetGroupPermission(string $permission, ?string $worldName = null): bool
    {
        if ($worldName == null) {
            $tempGroupData = $this->getData();
            if (in_array($permission, $tempGroupData["permissions"])) {
                $tempGroupData["permissions"] = array_diff($tempGroupData["permissions"], [$permission]);
                $this->setData($tempGroupData);
            } else {
                return false;
            }
        } else {
            $worldData = $this->getWorldData($worldName);
            if (!is_array($worldData)) {
                return false;
            }

            if (in_array($permission, $worldData["permissions"])) {
                $worldData["permissions"] = array_diff($worldData["permissions"], [$permission]);
                $this->setWorldData($worldName, $worldData);
            } else {
                return false;
            }
        }
        $this->plugin->updatePlayersInGroup($this);
        return true;
    }
}
