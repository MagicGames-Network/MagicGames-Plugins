<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;

class AddRank extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;
        
        parent::__construct($name, $description);
        $this->setPermission("pperms.command.addrank");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;
        if (!isset($args[0]) || count($args) > 1) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.addrank.usage"));
            return true;
        }

        $result = $this->plugin->addGroup($args[0]);
        if ($result === PurePerms::SUCCESS) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.addrank.messages.rank_added_successfully", $args[0]));
        } elseif ($result === PurePerms::ALREADY_EXISTS) {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.rank.messages.rank_already_exists", $args[0]));
        } else {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.addrank.messages.invalid_rank_name", $args[0]));
        }

        return true;
    }
}
