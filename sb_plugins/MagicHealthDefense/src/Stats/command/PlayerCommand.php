<?php

namespace Stats\command;

use pocketmine\Server;
use Stats\player\MagicPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class PlayerCommand extends Command
{
    public function __construct()
    {
        parent::__construct("player", "§eSet Stats Of Player", "/player <add/take/set/see> <player name> <Health/Defence/Damage> <amount>", [""]);
        $this->setPermission("player.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!isset($args[0]) || !isset($args[1])) {
            $sender->sendMessage("§e/player <add/take/set/see> <player name> <Health/Defence/Damage> <amount>");
            return;
        }
        $player = Server::getInstance()->getPlayerExact($args[1]);
        if (!$sender->hasPermission("player.cmd")) {
            $sender->sendMessage("Noob no permission");
            return;
        }
        if (!$player instanceof MagicPlayer) {
            $sender->sendMessage("That Player Offline");
            return;
        }
        switch ($args[0]) {
            case "add":
                switch ($args[2]) {
                    case "Health":
                        $player->setMaxHealth($player->getMaxHealth() + (int) $args[3]);
                        $player->setHealth($player->getMaxHealth());
                        break;
                    case "Defence":
                        $player->setStats("Defense", $player->getDefense() + (int) $args[3]);
                        break;
                    case "Damage":
                        $player->setStats("Damage", $player->getDamage() + (int) $args[3]);
                        break;
                    default:
                        $sender->sendMessage("§e/player <add/take/set/see> <player name> <Health/Defence/Damage> <amount>");
                        break;
                }
                break;
            case "take":
                switch ($args[2]) {
                    case "Health":
                        $player->setMaxHealth($player->getMaxHealth() - (int) $args[3]);
                        $player->setHealth($player->getMaxHealth());
                        break;
                    case "Defence":
                        $player->setStats("Defense", $player->getDefense() - (int) $args[3]);
                        break;
                    case "Damage":
                        $player->setStats("Damage", $player->getDamage() - (int) $args[3]);
                        break;
                    default:
                        $sender->sendMessage("§e/player <add/take/set/see> <player name> <Health/Defence/Damage> <amount>");
                        break;
                }
                break;
            case "set":
                switch ($args[2]) {
                    case "Health":
                        $player->setMaxHealth((int) $args[3]);
                        $player->setHealth($player->getMaxHealth());
                        break;
                    case "Defence":
                        $player->setStats("Defense", (int) $args[3]);
                        break;
                    case "Damage":
                        $player->setStats("Damage", (int) $args[3]);
                        break;
                    default:
                        $sender->sendMessage("§e/player <add/take/set/see> <player name> <Health/Defence/Damage> <amount>");
                        break;
                }
                break;
            case "see":
                $damage = $player->getDamage();
                $defense = $player->getDefense();
                $heal = $player->getHealth();
                $maxHealth = $player->getMaxHealth();
                $sender->sendMessage("§d§lSTATS:§r\n\n§cHealth: $heal" . "§7/§c$maxHealth \n\n§aDefense: §a$defense \n\n§4Damage: $damage ");
                break;
        }
    }
}
