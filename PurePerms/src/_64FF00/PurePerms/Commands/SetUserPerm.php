<?php

namespace _64FF00\PurePerms\Commands;

use pocketmine\plugin\Plugin;

use pocketmine\command\Command;
use _64FF00\PurePerms\PurePerms;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwnedTrait;

class SetUserPerm extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private PurePerms $plugin;

    public function __construct(PurePerms $plugin, string $name, Translatable|string $description)
    {
        $this->plugin = $plugin;

        parent::__construct($name, $description);
        $this->setPermission("pperms.command.setuperm");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender))
            return false;
        if (count($args) < 2 || count($args) > 3) {
            $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setuperm.usage"));
            return true;
        }

        $player = $this->plugin->getPlayer($args[0]);
        $permission = $args[1];
        $worldName = null;
        if (isset($args[2])) {
            $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($args[2]);
            if ($world === null) {
                $sender->sendMessage(TextFormat::RED . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setuperm.messages.level_not_exist", $args[2]));
                return true;
            }

            $worldName = $world->getFolderName();
        }

        $this->plugin->getUserDataMgr()->setPermission($player, $permission, $worldName);
        $sender->sendMessage(TextFormat::GREEN . PurePerms::MAIN_PREFIX . ' ' . $this->plugin->getMessage("cmds.setuperm.messages.uperm_added_successfully", $permission, $player->getName()));
        return true;
    }
}
