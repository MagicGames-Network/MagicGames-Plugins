<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\console\ConsoleCommandSender;

class PPInfo extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.ppinfo");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }
        
        $author = $this->plugin->getDescription()->getAuthors()[0];
        $version = $this->plugin->getDescription()->getVersion();
        if ($sender instanceof ConsoleCommandSender) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.ppinfo.messages.ppinfo_console", $version, $author));
        } else {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.ppinfo.messages.ppinfo_player", $version, $author));
        }

        return true;
    }
}
