<?php


namespace Heisenburger69\TempRanks;

use _64FF00\PurePerms\PPGroup;
use pocketmine\scheduler\Task;
use _64FF00\PurePerms\PurePerms;
use Heisenburger69\TempRanks\Main;

class CheckTask extends Task
{
    private Main $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(): void
    {
        /** @var PurePerms */
        $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
        $msg = $this->plugin->config->get("Rank Expired Message");
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $playername = $player->getName();
            $time = $this->plugin->getTimeLeft($playername);
            if ($time === null) {
                $rank = $pp->getUserDataMgr()->getGroup($pp->getPlayer($playername));
                if (!$rank instanceof PPGroup) {
                    return;
                }

                $msg = str_replace("{temprank}", $rank->getName(), $msg);
                $player->sendMessage($msg);
                $this->plugin->removeRank($playername);
            }
        }
    }
}
