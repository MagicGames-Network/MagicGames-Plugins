<?php

namespace _64FF00\PurePerms\Commands;

use _64FF00\PurePerms\PPGroup;
use pocketmine\player\Player;
use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\console\ConsoleCommandSender;

class SetRank extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;
    
    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.setrank");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2 || count($args) > 4) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.usage"));
            return true;
        }
        $player = $this->plugin->getPlayer($args[0]);
        $group = $this->plugin->getGroup($args[1]);
        if ($group === null) {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.rank_not_exist", $args[1]));
            return true;
        }

        $expTime = -1;
        if (isset($args[2])) {
            $expTime = $this->plugin->date2Int($args[2]);
        }

        $worldName = null;
        if (isset($args[3])) {
            $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($args[3]);
            if ($world === null) {
                $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.level_not_exist", $args[3]));
                return true;
            }

            $worldName = $world->getFolderName();
        }

        $tmpSuperAdminRanks = [];
        $superAdminRanks = $this->plugin->getConfigValue("superadmin-ranks");
        foreach (array_values($superAdminRanks) as $value) {
            $tmpSuperAdminRanks[$value] = 1;
        }

        if (!$sender instanceof ConsoleCommandSender) {
            if (isset($tmpSuperAdminRanks[$group->getName()])) {
                $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.access_denied_01", $group->getName()));
                return true;
            }

            $userGroup = $this->plugin->getUserDataMgr()->getGroup($player, $worldName);
            if (!$userGroup instanceof PPGroup) {
                return true;
            }

            if (isset($tmpSuperAdminRanks[$userGroup->getName()])) {
                $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.access_denied_02", $userGroup->getName()));
                return true;
            }
        }
        $this->plugin->getUserDataMgr()->setGroup($player, $group, $worldName, $expTime);

        $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.setrank_successfully", $player->getName()));
        if ($player instanceof Player) {
            /** @phpstan-ignore-next-line */
            if (!$this->plugin->getConfigValue("enable-multiworld-perms") || ($this->plugin->getConfigValue("enable-multiworld-perms") && $worldName === $player->getWorld()->getFolderName())) {
                $player->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setrank.messages.on_player_rank_change", strtolower($group->getName())));
            }
        }

        return true;
    }
}
