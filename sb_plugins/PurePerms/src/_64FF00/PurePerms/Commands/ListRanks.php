<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;

class ListRanks extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.ranks");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;

        $result = [];
        foreach ($this->plugin->getGroups() as $group) {
            $result[] = $group->getName();
        }
        $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.ranks.messages.all_registered_ranks", implode(", ", $result)));
        return true;
    }
}
