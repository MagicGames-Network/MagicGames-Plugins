<?php

namespace Pushkar\MagicCore\utils;

use pocketmine\player\Player;
use Pushkar\MagicCore\MagicCore;
use pocketmine\network\mcpe\protocol\types\DeviceOS;

final class Utils
{
    public function resetNick(Player $sender): void
    {
        $sender->setDisplayName($sender->getName());
        $sender->setNameTag($sender->getName());
        $sender->sendMessage("§8(§b!§8) §7Your nickname has been reset!");
    }

    public static function callDirectory(string $directory, callable $callable): void
    {
        $main = explode("\\", MagicCore::getInstance()->getDescription()->getMain());
        unset($main[array_key_last($main)]);
        $main = implode("/", $main);
        $directory = rtrim(str_replace(DIRECTORY_SEPARATOR, "/", $directory), "/");
        $dir = MagicCore::getInstance()->getFile() . "src/$main/" . $directory;

        $scanDir = scandir($dir);
        if (!is_array($scanDir)) {
            return;
        }

        foreach (array_diff($scanDir, [".", ".."]) as $file) {
            $path = $dir . "/$file";
            $extension = pathinfo($path)["extension"] ?? null;

            if ($extension === null) {
                self::callDirectory($directory . "/" . $file, $callable);
            } elseif ($extension === "php") {
                $namespaceDirectory = str_replace("/", "\\", $directory);
                $namespaceMain = str_replace("/", "\\", $main);
                $namespace = $namespaceMain . "\\$namespaceDirectory\\" . basename($file, ".php");
                $callable($namespace);
            }
        }
    }

    public static function getPlayerPlatform(Player $player): string
    {
        $extraData = $player->getPlayerInfo()->getExtraData();

        if ($extraData["DeviceOS"] === DeviceOS::ANDROID && $extraData["DeviceModel"] === "") {
            return "Linux";
        }

        return match ($extraData["DeviceOS"]) {
            DeviceOS::ANDROID => "Android",
            DeviceOS::IOS => "iOS",
            DeviceOS::OSX => "macOS",
            DeviceOS::AMAZON => "FireOS",
            DeviceOS::GEAR_VR => "Gear VR",
            DeviceOS::HOLOLENS => "Hololens",
            DeviceOS::WINDOWS_10 => "Windows",
            DeviceOS::WIN32 => "Windows 7 (Edu)",
            DeviceOS::DEDICATED => "Dedicated",
            DeviceOS::TVOS => "TV OS",
            DeviceOS::PLAYSTATION => "PlayStation",
            DeviceOS::NINTENDO => "Nintendo Switch",
            DeviceOS::XBOX => "Xbox",
            DeviceOS::WINDOWS_PHONE => "Windows Phone",
            default => "Unknown"
        };
    }
}
