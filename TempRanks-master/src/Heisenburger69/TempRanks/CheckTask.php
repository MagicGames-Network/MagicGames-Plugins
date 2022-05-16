<?php


namespace Heisenburger69\TempRanks;

use pocketmine\scheduler\Task;

class CheckTask extends Task
{

    public function __construct(\Heisenburger69\TempRanks\Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(): void
    {
        $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
        $msg = $this->plugin->config->get("Rank Expired Message");
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $playername = $player->getName();
            $time = $this->plugin->getTimeLeft($playername);
            if($time === null) {
                $rank = $pp->getUserDataMgr()->getGroup($pp->getPlayer($playername), );
                $msg = str_replace("{temprank}", $rank, $msg);
                $player->sendMessage($msg);
                $this->plugin->removeRank($playername);
            }
        }
    }
}