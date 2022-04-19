<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\console\ConsoleCommandSender;

class PLPerms extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.plperms");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;
        if (!isset($args[0]) || count($args) > 2) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.plperms.usage"));
            return true;
        }

        $plugin = (strtolower($args[0]) === 'pocketmine' || strtolower($args[0]) === 'pmmp') ? 'pocketmine' : $this->plugin->getServer()->getPluginManager()->getPlugin($args[0]);
        if (!$plugin instanceof Plugin) {
            $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.plperms.messages.plugin_not_exist", $args[0]));
            return true;
        }

        $permissions = $plugin instanceof PluginBase ? $plugin->getDescription()->getPermissions() : $this->plugin->getPocketMinePerms();
        if ($permissions === []) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.plperms.messages.no_plugin_perms", $plugin->getName()));
            return true;
        }

        $pageHeight = $sender instanceof ConsoleCommandSender ? 48 : 6;
        $chunkedPermissions = array_chunk($permissions, $pageHeight);
        $maxPageNumber = count($chunkedPermissions);
        if (!isset($args[1]) || !is_numeric($args[1]) || $args[1] <= 0) {
            $pageNumber = 1;
        } else if ($args[1] > $maxPageNumber) {
            $pageNumber = $maxPageNumber;
        } else {
            $pageNumber = $args[1];
        }

        $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.plperms.messages.plugin_perms_list", ($plugin instanceof PluginBase) ? $plugin->getName() : 'PocketMine-MP', (string) $pageNumber, (string) $maxPageNumber));
        foreach ($chunkedPermissions[$pageNumber - 1] as $permission) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' - ' . $permission->getName());
        }
        return true;
    }
}
