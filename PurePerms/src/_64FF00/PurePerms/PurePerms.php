<?php

namespace _64FF00\PurePerms;

use RuntimeException;
use pocketmine\player\Player;
use pocketmine\player\IPlayer;
use pocketmine\plugin\PluginBase;
use _64FF00\PurePerms\Commands\PPInfo;
use _64FF00\PurePerms\Commands\RmRank;
use _64FF00\PurePerms\Commands\AddRank;
use _64FF00\PurePerms\Commands\DefRank;
use _64FF00\PurePerms\Commands\PLPerms;
use _64FF00\PurePerms\Commands\SetRank;
use _64FF00\PurePerms\Commands\ListRanks;
use _64FF00\PurePerms\Commands\SetUserPerm;
use pocketmine\permission\PermissionManager;
use _64FF00\PurePerms\Commands\UnSetUserPerm;
use _64FF00\PurePerms\Task\PPExpDateCheckTask;
use pocketmine\permission\PermissionAttachment;
use _64FF00\PurePerms\DataProviders\JsonProvider;
use _64FF00\PurePerms\DataManager\UserDataManager;
use _64FF00\PurePerms\DataProviders\DefaultProvider;
use _64FF00\PurePerms\DataProviders\SQLite3Provider;
use _64FF00\PurePerms\DataProviders\ProviderInterface;

class PurePerms extends PluginBase
{
    const MAIN_PREFIX = "\x5b\x50\x75\x72\x65\x50\x65\x72\x6d\x73\x3a\x36\x34\x46\x46\x30\x30\x5d";
    const CORE_PERM = "\x70\x70\x65\x72\x6d\x73\x2e\x63\x6f\x6d\x6d\x61\x6e\x64\x2e\x70\x70\x69\x6e\x66\x6f";

    const NOT_FOUND = null;
    const INVALID_NAME = -1;
    const ALREADY_EXISTS = 0;
    const SUCCESS = 1;

    private bool $isGroupsLoaded = false;

    private PPMessages $messages;
    private ProviderInterface $provider;
    private UserDataManager $userDataMgr;

    private array $attachments = [];
    /** @var PPGroup[] */
    private array $groups = [];

    public function onLoad(): void
    {
        $this->saveDefaultConfig();
        $this->messages = new PPMessages($this);
        $this->userDataMgr = new UserDataManager($this);
    }

    public function onEnable(): void
    {
        $this->registerCommands();
        $this->setProvider();
        $this->registerPlayers();
        $this->getServer()->getPluginManager()->registerEvents(new PPListener($this), $this);
        $this->getScheduler()->scheduleRepeatingTask(new PPExpDateCheckTask($this), 72000);
    }

    public function onDisable(): void
    {
        $this->unregisterPlayers();
        if ($this->isValidProvider()) {
            $this->provider->close();
        }
    }

    private function registerCommands(): void
    {
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->register("pureperms", new AddRank($this, "addrank", $this->getMessage("cmds.addgroup.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new DefRank($this, "defrank", $this->getMessage("cmds.defgroup.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new PLPerms($this, "plperms", $this->getMessage("cmds.plperms.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new ListRanks($this, "listranks", $this->getMessage("cmds.groups.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new PPInfo($this, "ppinfo", $this->getMessage("cmds.ppinfo.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new RmRank($this, "rmrank", $this->getMessage("cmds.rmgroup.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new SetRank($this, "setrank", $this->getMessage("cmds.setgroup.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new SetUserPerm($this, "setuperm", $this->getMessage("cmds.setuperm.desc") . ' #64FF00'));
        $commandMap->register("pureperms", new UnSetUserPerm($this, "unsetuperm", $this->getMessage("cmds.unsetuperm.desc") . ' #64FF00'));
    }

    private function setProvider(bool $onEnable = true): void
    {
        $providerName = $this->getConfigValue("data-provider");
        switch (strtolower($providerName)) {
            case "sqlite3":
                $provider = new SQLite3Provider($this);
                if ($onEnable === true)
                    $this->getLogger()->notice($this->getMessage("logger_messages.setProvider_SQLITE3"));
                break;
            case "json":
                $provider = new JsonProvider($this);
                if ($onEnable === true)
                    $this->getLogger()->notice($this->getMessage("logger_messages.setProvider_JSON"));
                break;
            default:
                $provider = new DefaultProvider($this);
                if ($onEnable === true)
                    $this->getLogger()->warning($this->getMessage("logger_messages.setProvider_NotFound", "'$providerName'"));
                break;
        }
        $this->provider = $provider;
        $this->updateGroups();
    }

    /*
          888  888          d8888 8888888b. 8888888
          888  888         d88888 888   Y88b  888
        888888888888      d88P888 888    888  888
          888  888       d88P 888 888   d88P  888
          888  888      d88P  888 8888888P"   888
        888888888888   d88P   888 888         888
          888  888    d8888888888 888         888
          888  888   d88P     888 888       8888888
    */

    public function addGroup(string $groupName): int
    {
        $groupsData = $this->getProvider()->getGroupsData();
        if (!$this->isValidGroupName($groupName)) {
            return self::INVALID_NAME;
        }
        if (isset($groupsData[$groupName])) {
            return self::ALREADY_EXISTS;
        }
        
        $groupsData[$groupName] = [
            "alias" => "",
            "isDefault" => false,
            "inheritance" => [],
            "permissions" => [],
            "worlds" => []
        ];
        $this->getProvider()->setGroupsData($groupsData);
        $this->updateGroups();
        return self::SUCCESS;
    }

    public function date2Int(string $date): int
    {
        if ((is_int(preg_match("/([0-9]+)d([0-9]+)h([0-9]+)m/", $date, $result_array)) ? true : false) && count($result_array) === 4) {
            return time() + ($result_array[1] * 86400) + ($result_array[2] * 3600) + ($result_array[3] * 60);
        }
        return -1;
    }

    public function getAttachment(Player $player): ?PermissionAttachment
    {
        $uniqueId = $this->getValidUUID($player);
        if (!isset($this->attachments[$uniqueId])) {
            return null;
        }
        return $this->attachments[$uniqueId];
    }

    /**
     * @return bool|mixed|null
     */
    public function getConfigValue(string $key)
    {
        $value = $this->getConfig()->getNested($key);
        if ($value === null) {
            $this->getLogger()->warning($this->getMessage("logger_messages.getConfigValue_01", $key));
            return null;
        }
        return $value;
    }

    public function getDefaultGroup(?string $worldName = null): PPGroup
    {
        $defaultGroups = [];
        foreach ($this->getGroups() as $defaultGroup) {
            if ($defaultGroup->isDefault($worldName)) {
                $defaultGroups[] = $defaultGroup;
            }
        }

        if (count($defaultGroups) === 1) {
            return $defaultGroups[0];
        } else {
            if (count($defaultGroups) > 1) {
                $this->getLogger()->warning($this->getMessage("logger_messages.getDefaultGroup_01"));
            } else {
                $this->getLogger()->warning($this->getMessage("logger_messages.getDefaultGroup_02"));
            }
            $this->getLogger()->info($this->getMessage("logger_messages.getDefaultGroup_03"));

            foreach ($this->getGroups() as $tempGroup) {
                if (count($tempGroup->getParentGroups()) === 0) {
                    $this->setDefaultGroup($tempGroup, $worldName);
                    return $tempGroup;
                }
            }
        }
        throw new RuntimeException("No default group found");
    }

    public function getGroup(string $groupName): ?PPGroup
    {
        if (!isset($this->groups[$groupName])) {
            foreach ($this->groups as $group) {
                if ($group->getAlias() === $groupName)
                    return $group;
            }
            $this->getLogger()->debug($this->getMessage("logger_messages.getGroup_01", $groupName));
            return null;
        }

        /** @var PPGroup $group */
        $group = $this->groups[$groupName];

        /** @phpstan-ignore-next-line */
        if (empty($group->getData())) {
            $this->getLogger()->warning($this->getMessage("logger_messages.getGroup_02", $groupName));
            return null;
        }

        return $group;
    }

    /**
     * @return PPGroup[]
     */
    public function getGroups(): array
    {
        if ($this->isGroupsLoaded !== true) {
            throw new RuntimeException("No groups loaded, maybe a provider error?");
        }
        return $this->groups;
    }

    public function getMessage(string $node, string ...$vars): mixed
    {
        return $this->messages->getMessage($node, $vars);
    }

    public function getOnlinePlayersInGroup(PPGroup $group): array
    {
        $users = [];
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            foreach ($this->getServer()->getWorldManager()->getWorlds() as $World) {
                $worldName = $World->getFolderName();
                if ($this->userDataMgr->getGroup($player, $worldName) === $group) {
                    $users[] = $player;
                }
            }
        }
        return $users;
    }

    public function getPermissions(IPlayer $player, string $worldName): array
    {
        $group = $this->userDataMgr->getGroup($player, $worldName);
        if (!$group instanceof PPGroup) {
            return [];
        }

        $groupPerms = $group->getGroupPermissions($worldName);
        $userPerms = $this->userDataMgr->getUserPermissions($player, $worldName);

        return array_merge($groupPerms, $userPerms);
    }

    public function getPlayer(string $userName): IPlayer|Player
    {
        $player = $this->getServer()->getPlayerByPrefix($userName);
        return $player instanceof Player ? $player : $this->getServer()->getOfflinePlayer($userName);
    }

    public function getPocketMinePerms(): array
    {
        return array_keys(PermissionManager::getInstance()->getPermissions());
    }

    public function getPPVersion(): string
    {
        return $this->getDescription()->getVersion();
    }

    public function getProvider(): ProviderInterface
    {
        if (!$this->isValidProvider()) {
            $this->setProvider(false);
        }
        return $this->provider;
    }

    public function getUserDataMgr(): UserDataManager
    {
        return $this->userDataMgr;
    }

    public function getValidUUID(Player $player): string
    {
        return $player->getUniqueId()->toString();
    }

    public function isValidGroupName(string $groupName): bool
    {
        return is_int(preg_match('/[0-9a-zA-Z\xA1-\xFE]$/', $groupName)) ? true : false;
    }

    public function isValidProvider(): bool
    {
        if (!isset($this->provider)) {
            return false;
        }
        return true;
    }

    public function registerPlayer(Player $player): void
    {
        $this->getLogger()->debug($this->getMessage("logger_messages.registerPlayer", $player->getName()));
        $uniqueId = $this->getValidUUID($player);
        if (!isset($this->attachments[$uniqueId])) {
            $attachment = $player->addAttachment($this);
            $this->attachments[$uniqueId] = $attachment;
            $this->updatePermissions($player);
        }
    }

    public function registerPlayers(): void
    {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            $this->registerPlayer($player);
        }
    }

    public function removeGroup(string $groupName): ?int
    {
        if (!$this->isValidGroupName($groupName)) {
            return self::INVALID_NAME;
        }

        $groupsData = $this->getProvider()->getGroupsData();
        if (!isset($groupsData[$groupName])) {
            return self::NOT_FOUND;
        }

        unset($groupsData[$groupName]);
        $this->getProvider()->setGroupsData($groupsData);
        $this->updateGroups();
        return self::SUCCESS;
    }

    public function setDefaultGroup(PPGroup $group, ?string $worldName = null): void
    {
        foreach ($this->getGroups() as $currentGroup) {
            if (!is_string($worldName)) {
                $isDefault = $currentGroup->getNode("isDefault");

                if ($isDefault) {
                    $currentGroup->removeNode("isDefault");
                }
            } else {
                $isDefault = $currentGroup->getWorldNode($worldName, "isDefault");
                if ($isDefault) {
                    $currentGroup->removeWorldNode($worldName, "isDefault");
                }
            }
        }
        $group->setDefault($worldName);
    }

    public function setGroup(IPlayer $player, PPGroup $group, ?string $worldName = null, int $time = -1): void
    {
        $this->userDataMgr->setGroup($player, $group, $worldName, $time);
    }

    public function sortGroupData(): void
    {
        foreach ($this->getGroups() as $groupName => $ppGroup) {
            $ppGroup->sortPermissions();

            if ($this->getConfigValue("enable-multiworld-perms")) {
                foreach ($this->getServer()->getWorldManager()->getWorlds() as $world) {
                    $worldName = $world->getFolderName();
                    $ppGroup->createWorldData($worldName);
                }
            }
        }
    }

    public function updateGroups(): void
    {
        if (!$this->isValidProvider()) {
            throw new RuntimeException("Failed to load groups: Invalid data provider");
        }

        // Make group list empty first to reload it
        $this->groups = [];
        foreach (array_keys($this->getProvider()->getGroupsData()) as $groupName) {
            $this->groups[(string) $groupName] = new PPGroup($this, (string) $groupName);
        }

        if ($this->groups === []) {
            throw new RuntimeException("No groups found, I guess there's definitely something wrong with your data provider... *cough cough*");
        }
        $this->isGroupsLoaded = true;
        $this->sortGroupData();
    }

    public function updatePermissions(IPlayer $player, ?string $worldName = null): void
    {
        if ($player instanceof Player) {
            if ($this->getConfigValue("enable-multiworld-perms") == null) {
                return;
            } elseif ($worldName == null) {
                $worldName = $player->getWorld()->getFolderName();
            }
            $permissions = [];
            /** @var string $permission */
            foreach ($this->getPermissions($player, $worldName) as $permission) {
                if ($permission === '*') {
                    foreach (PermissionManager::getInstance()->getPermissions() as $tmp) {
                        $permissions[$tmp->getName()] = true;
                    }
                } else {
                    $isNegative = substr($permission, 0, 1) === "-";
                    if ($isNegative)
                        $permission = substr($permission, 1);

                    $permissions[$permission] = !$isNegative;
                }
            }

            $permissions[self::CORE_PERM] = true;
            $attachment = $this->getAttachment($player);
            if (!$attachment instanceof PermissionAttachment) {
                return;
            }

            $attachment->clearPermissions();
            $attachment->setPermissions($permissions);
        }
    }

    public function updatePlayersInGroup(PPGroup $group): void
    {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            if ($this->userDataMgr->getGroup($player) === $group) {
                $this->updatePermissions($player);
            }
        }
    }

    public function unregisterPlayer(Player $player): void
    {
        $this->getLogger()->debug($this->getMessage("logger_messages.unregisterPlayer", $player->getName()));
        
        $uniqueId = $this->getValidUUID($player);
        if (isset($this->attachments[$uniqueId])) {
            $player->removeAttachment($this->attachments[$uniqueId]);
        }
        unset($this->attachments[$uniqueId]);
    }

    public function unregisterPlayers(): void
    {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            $this->unregisterPlayer($player);
        }
    }
}
