<?php

namespace Quest\utils;

use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

final class Utils
{
    public static function addSound(Player $player, int $volume = 2, int $pitch = 1, string $sound_name = "note.bell"): void
    {
        $sound = new PlaySoundPacket();
        $sound->soundName = $sound_name;
        $sound->x = $player->getPosition()->getX();
        $sound->y = $player->getPosition()->getY();
        $sound->z = $player->getPosition()->getZ();
        $sound->volume = $volume;
        $sound->pitch = $pitch;
        
        $player->getNetworkSession()->sendDataPacket($sound);
    }
}
