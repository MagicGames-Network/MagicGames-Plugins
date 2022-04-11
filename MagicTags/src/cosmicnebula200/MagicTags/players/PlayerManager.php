<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags\players;

use cosmicnebula200\MagicTags\queries\Queries;
use pocketmine\player\Player as P;
use cosmicnebula200\MagicTags\MagicTags;
use Ramsey\Uuid\Uuid;

class PlayerManager
{

    /**@var Player[]*/
    private array $players = [];

    public function __construct()
    {
        MagicTags::getInstance()->getDatabase()->executeSelect(Queries::LOAD_DB, [], function (array $rows): void
        {
            foreach ($rows as $row)
            {
                $this->players[$row["name"]] = new Player($row["uuid"], $row["name"], $row["tags"], $row["currenttag"]);
            }
        });
    }

    public function createPlayer(P $player): Player
    {
        MagicTags::getInstance()->getDatabase()->executeInsert(Queries::CREATE_PLAYER, [
            "uuid" => $player->getUniqueId()->toString(),
            "name" => strtolower($player->getName()),
            "tags" => "",
            "currenttag" => ""
        ]);
        $this->players[strtolower($player->getName())] = new Player($player->getUniqueId()->toString(), strtolower($player->getName()), '' , '');
        return $this->players[strtolower($player->getName())];
    }

    public function getPlayerByName(string $name): ?Player
    {
        return $this->players[strtolower($name)] ?? null;
    }

    public function getPlayer(P $player): ?Player
    {
        return $this->players[strtolower($player->getName())] ?? null;
    }

    public function getPlayerByUUID(UUID $UUID): ?Player
    {
        foreach ($this->players as $player)
        {
            if ($player->getUUID() == $UUID)
                return $player;
        }
        return null;
    }

}