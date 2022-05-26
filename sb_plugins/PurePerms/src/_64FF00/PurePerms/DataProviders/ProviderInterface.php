<?php

namespace _64FF00\PurePerms\DataProviders;

use _64FF00\PurePerms\PPGroup;
use pocketmine\player\IPlayer;

interface ProviderInterface
{
    public function getGroupData(PPGroup $group): mixed;
    public function getGroupsData(): mixed;
    public function getPlayerData(IPlayer $player): array;
    public function getUsers(): void;
    public function setGroupData(PPGroup $group, array $tempGroupData): void;
    public function setGroupsData(array $tempGroupsData): void;
    public function setPlayerData(IPlayer $player, array $tempPlayerData): void;
    public function close(): void;
}
