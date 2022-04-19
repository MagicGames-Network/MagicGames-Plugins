<?php

namespace _64FF00\PurePerms\DataProviders;

use SQLite3;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;

class SQLite3Provider implements ProviderInterface
{
    //private PurePerms $plugin;
    private SQLite3 $db;
    
    //private array $groupsData = [];

    /**
     * @param PurePerms $plugin
     */
    public function __construct(PurePerms $plugin)
    {
        //$this->plugin = $plugin;

        $this->db = new SQLite3($plugin->getDataFolder() . "pureperms.db");
        $this->db->exec("");

        $this->loadGroupsData();
    }

    public function loadGroupsData(): void
    {
        //
    }

    public function getGroupData(PPGroup $group): mixed
    {
        return [];
    }

    public function getGroupsData(): mixed
    {
        return [];
    }

    public function getPlayerData(IPlayer $player): array
    {
        return [];
    }

    public function getUsers(): void
    {
    }

    public function setGroupData(PPGroup $group, array $tempGroupData): void
    {
    }

    public function setGroupsData(array $tempGroupsData): void
    {
    }

    public function setPlayerData(IPlayer $player, array $tempPlayerData): void
    {
    }

    public function close(): void
    {
    }
}
