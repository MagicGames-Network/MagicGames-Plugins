<?php

namespace _64FF00\PurePerms\DataProviders;

use mysqli;
use mysqli_result;
use RuntimeException;
use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;
use _64FF00\PurePerms\PurePerms;
use _64FF00\PurePerms\Task\PPMySQLTask;

class MySQLProvider implements ProviderInterface
{
    private mysqli $db;
    private PurePerms $plugin;

    private array $groupsData = [];

    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;

        $mySQLSettings = $this->plugin->getConfigValue("mysql-settings");
        if (!isset($mySQLSettings["host"]) || !isset($mySQLSettings["port"]) || !isset($mySQLSettings["user"]) || !isset($mySQLSettings["password"]) || !isset($mySQLSettings["db"])) {
            throw new RuntimeException("Failed to connect to the MySQL database: Invalid MySQL settings");
        }

        $this->db = new mysqli($mySQLSettings["host"], $mySQLSettings["user"], $mySQLSettings["password"], $mySQLSettings["db"], $mySQLSettings["port"]);
        if ($this->db->connect_error) {
            throw new RuntimeException("Failed to connect to the MySQL database: " . $this->db->connect_error);
        }

        $resource = $this->plugin->getResource("mysql_deploy_01.sql");
        if (!is_resource($resource)) {
            throw new RuntimeException("Failed to deploy groups SQL script");
        }
        $contents = stream_get_contents($resource);
        if ($contents === false) {
            throw new RuntimeException("Failed to deploy groups SQL script");
        }

        $this->db->multi_query($contents);
        while ($this->db->more_results()) {
            $this->db->next_result();
        }

        fclose($resource);
        $this->loadGroupsData();
        $this->plugin->getScheduler()->scheduleRepeatingTask(new PPMySQLTask($this->plugin, $this->db), 1200);
    }

    public function getGroupData(PPGroup $group): array
    {
        $groupName = $group->getName();
        if (!isset($this->getGroupsData()[$groupName]) || !is_array($this->getGroupsData()[$groupName])) return [];
        return $this->getGroupsData()[$groupName];
    }

    public function getGroupsData(): array
    {
        return $this->groupsData;
    }

    public function getPlayerData(IPlayer $player): array
    {
        $userData = [
            "userName" => $player->getName(),
            "group" => $this->plugin->getDefaultGroup()->getName(),
            "permissions" => []
        ];

        $result01 = $this->db->query("SELECT * FROM players WHERE userName = '" .  $this->db->escape_string($player->getName()) . "';");
        if ($result01 instanceof mysqli_result) {
            while ($currentRow = $result01->fetch_assoc()) {
                $userData["group"] = $currentRow["userGroup"];
                $userData["permissions"] =  explode(",", $currentRow["permissions"]);
            }

            $result01->free();
        }
        $result02 = $this->db->query("SELECT * FROM players_mw WHERE userName = '" .  $this->db->escape_string($player->getName()) . "';");
        if ($result02 instanceof mysqli_result) {
            while ($currentRow = $result02->fetch_assoc()) {
                $userGroup = $currentRow["userGroup"];
                $worldName = $currentRow["worldName"];
                $worldPerms = explode(",", $currentRow["permissions"]);

                $userData["worlds"][$worldName]["group"] = $userGroup;

                $userData["worlds"][$worldName]["permissions"] = $worldPerms;
            }

            $result02->free();
        }
        return $userData;
    }

    public function getUsers(): void
    {
        // TODO
    }

    public function loadGroupsData(): void
    {
        $result01 = $this->db->query("SELECT * FROM groups;");

        if ($result01 instanceof mysqli_result) {
            if ($result01->num_rows <= 0) {
                $this->plugin->getLogger()->notice("No groups found in table 'groups', loading groups defined in default SQL script");

                $resource = $this->plugin->getResource("mysql_deploy_02.sql");
                if (!is_resource($resource)) {
                    throw new RuntimeException("Failed to load groups SQL script");
                }
                $contents = stream_get_contents($resource);
                if ($contents === false) {
                    throw new RuntimeException("Failed to deploy groups SQL script");
                }

                $this->db->multi_query($contents);
                while ($this->db->more_results()) {
                    $this->db->next_result();
                }

                fclose($resource);

                $result01 = $this->db->query("SELECT * FROM groups;");
            }
            if ($result01 instanceof mysqli_result) {
                while ($currentRow = $result01->fetch_assoc()) {
                    $groupName = $currentRow["groupName"];
                    $this->groupsData[$groupName]["alias"] = $currentRow["alias"];
                    $this->groupsData[$groupName]["isDefault"] = $currentRow["isDefault"] === "1" ? true : false;
                    $this->groupsData[$groupName]["inheritance"] = $currentRow["inheritance"] !== "" ? explode(",", $currentRow["inheritance"]) : [];
                    $this->groupsData[$groupName]["permissions"] = explode(",", $currentRow["permissions"]);
                }
                $result01->free();
            }
        }

        $result02 = $this->db->query("SELECT * FROM groups_mw;");
        if ($result02 instanceof mysqli_result) {
            while ($currentRow = $result02->fetch_assoc()) {
                $isDefault = $currentRow["isDefault"] === "1" ? true : false;
                $groupName = $currentRow["groupName"];
                $worldName = $currentRow["worldName"];
                $worldPerms = explode(",", $currentRow["permissions"]);
                $this->groupsData[$groupName]["worlds"][$worldName]["isDefault"] = $isDefault;
                $this->groupsData[$groupName]["worlds"][$worldName]["permissions"] = $worldPerms;
            }

            $result02->free();
        }
    }

    public function removeGroupData(string $groupName): void
    {
        $this->db->query("
            DELETE FROM groups
            WHERE groupName = '" . $this->db->escape_string($groupName) . "';");
        $this->db->query("
            DELETE OR IGNORE FROM groups_mw
            WHERE groupName = '" . $this->db->escape_string($groupName) . "';");
    }

    public function setGroupData(PPGroup $group, array $tempGroupData): void
    {
        $groupName = $group->getName();

        $this->updateGroupData($groupName, $tempGroupData);
        $this->loadGroupsData();
    }

    public function setGroupsData(array $tempGroupsData): void
    {
        $tempGroupData01 = array_diff_key($this->groupsData, $tempGroupsData);
        $tempGroupName01 = key($tempGroupData01);
        if (!is_string($tempGroupName01)) {
            return;
        }

        if ($tempGroupData01 !== []) {
            $this->removeGroupData($tempGroupName01);
        }

        foreach ($tempGroupsData as $tempGroupName02 => $tempGroupData02) {
            $this->updateGroupData($tempGroupName02, $tempGroupData02);
        }
        $this->loadGroupsData();
    }

    public function setPlayerData(IPlayer $player, array $tempUserData): void
    {
        if (isset($tempUserData["group"]) and isset($tempUserData["permissions"])) {
            $userName = $player->getName();
            $userGroup = $tempUserData["group"];
            $permissions = implode(",", $tempUserData["permissions"]);

            $this->db->query("INSERT INTO players
                (userName, userGroup, permissions)
                VALUES
                ('" . $this->db->escape_string($userName) . "', '" . $this->db->escape_string($userGroup) . "', '" . $this->db->escape_string($permissions) . "')
                ON DUPLICATE KEY UPDATE
                userGroup = VALUES(userGroup),
                permissions = VALUES(permissions);");
        }
    }

    public function updateGroupData(string $groupName, array $tempGroupData): void
    {
        if (isset($tempGroupData["isDefault"]) and isset($tempGroupData["inheritance"]) and isset($tempGroupData["permissions"])) {
            $alias = $tempGroupData["alias"];
            $isDefault = $tempGroupData["isDefault"] === true ? "1" : "0";
            $inheritance = implode(",", $tempGroupData["inheritance"]);
            $permissions = implode(",", $tempGroupData["permissions"]);
            $this->db->query("INSERT INTO groups
                (groupName, alias, isDefault, inheritance, permissions)
                VALUES
                ('" . $this->db->escape_string($groupName) . "', '" . $this->db->escape_string($alias) . "', '" . $this->db->escape_string($isDefault) . "', '" . $this->db->escape_string($inheritance) . "', '" . $this->db->escape_string($permissions) . "')
                ON DUPLICATE KEY UPDATE
                alias = VALUES(alias),
                isDefault = VALUES(isDefault),
                inheritance = VALUES(inheritance),
                permissions = VALUES(permissions);");

            if (isset($tempGroupData["worlds"])) {
                foreach ($tempGroupData["worlds"] as $worldName => $worldData) {
                    $isDefault = $worldData["isDefault"]  === true ? "1" : "0";
                    $worldPerms = implode(",", $worldData["permissions"]);
                    $this->db->query("INSERT INTO groups_mw
                        (groupName, isDefault, worldName, permissions)
                        VALUES
                        ('" . $this->db->escape_string($groupName) . "', '" . $this->db->escape_string($isDefault) . "', '" . $this->db->escape_string($worldName) . "', '" . $this->db->escape_string($worldPerms) . "')
                        ON DUPLICATE KEY UPDATE
                        isDefault = VALUES(isDefault),
                        worldName = VALUES(worldName),
                        permissions = VALUES(permissions);");
                }
            }
        }
    }

    public function close(): void
    {
        $this->db->close();
    }
}
