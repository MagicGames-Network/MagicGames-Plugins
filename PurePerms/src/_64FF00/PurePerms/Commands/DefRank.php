<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;

class DefRank extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;
        parent::__construct($name, $description);
        $this->setPermission("pperms.command.defrank");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;

        if (!isset($args[0]) || count($args) > 2) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.defrank.usage"));
            return true;
        }

        $group = $this->plugin->getGroup($args[0]);
        if ($group === null) {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.defrank.messages.rank_not_exist", $args[0]));
            return true;
        }
        $worldName = null;
        if (isset($args[1])) {
            $World = $this->plugin->getServer()->getWorldManager()->getWorldByName($args[1]);
            if ($World === null) {
                $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.defrank.messages.level_not_exist", $args[1]));
                return true;
            }

            $worldName = $World->getFolderName();
        }
        $this->plugin->setDefaultGroup($group, $worldName);
        $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.defrank.messages.defrank_successfully", $args[0]));

        return true;
    }
}
