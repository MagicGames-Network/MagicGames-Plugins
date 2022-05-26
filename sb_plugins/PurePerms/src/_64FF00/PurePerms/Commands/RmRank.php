<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;

class RmRank extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.rmrank");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;
        if (!isset($args[0]) || count($args) > 1) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.rmrank.usage"));
            return true;
        }

        $result = $this->plugin->removeGroup($args[0]);
        if ($result === PurePerms::SUCCESS) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.rmrank.messages.ranks_removed_successfully", $args[0]));
        } elseif ($result === PurePerms::INVALID_NAME) {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.rmrank.messages.invalid_ranks_name", $args[0]));
        } else {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.rmrank.messages.ranks_not_exist", $args[0]));
        }

        return true;
    }
}
