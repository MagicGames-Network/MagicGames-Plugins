<?php

namespace _64FF00\PurePerms;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use _64FF00\PurePerms\PurePerms;
use AGTHARN\MagicSync\MagicSync;
use pocketmine\utils\TextFormat;
use pocketmine\lang\Translatable;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use _64FF00\PurePerms\EventManager\PPRankChangedEvent;
use _64FF00\PurePerms\EventManager\PPRankExpiredEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class PPListener implements Listener
{
    private PurePerms $plugin;

    public function __construct(PurePerms $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @priority LOWEST
     */
    public function onGroupChanged(PPRankChangedEvent $event): void
    {
        $player = $event->getPlayer();
        $this->plugin->updatePermissions($player);
    }

    /**
     * @priority MONITOR
     */
    public function onLevelChange(EntityTeleportEvent $event): void
    {
        MagicSync::getInstance()->addEntityTeleport($event->getEntity(), new ClosureTask(function () use ($event): void {
            if ($event->isCancelled()) {
                return;
            }

            $player = $event->getEntity();
            if ($player instanceof Player) {
                $this->plugin->updatePermissions($player, $event->getTo()->getWorld()->getFolderName());
            }
        }), "CHECKING PERMISSIONS");
    }

    public function onPlayerCommand(PlayerCommandPreprocessEvent $event): void
    {
        $message = $event->getMessage();
        $player = $event->getPlayer();

        if (substr($message, 0, 1) === "/") {
            $command = substr($message, 1);
            $args = explode(" ", $command);

            /** @phpstan-ignore-next-line */
            if ($this->plugin->getConfigValue("disable-op") && $args[0] === "op") {
                $event->cancel();
                $player->sendMessage(new Translatable(TextFormat::RED . "%commands.generic.permission"));
            }
        }
    }

    /**
     * @priority LOWEST
     */
    public function onPlayerLogin(PlayerLoginEvent $event): void
    {
        $player = $event->getPlayer();
        $this->plugin->registerPlayer($player);
    }

    /**
     * @priority HIGHEST
     */
    public function onPlayerQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        $this->plugin->unregisterPlayer($player);
    }

    /**
     * @priority LOWEST
     */
    public function onRankExpired(PPRankExpiredEvent $event): void
    {
        $player = $event->getPlayer();
        $this->plugin->setGroup($player, $this->plugin->getDefaultGroup());
    }
}
