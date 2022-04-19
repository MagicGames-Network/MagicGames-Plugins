<?php

namespace _64FF00\PurePerms\Task;

use mysqli;
use pocketmine\scheduler\Task;
use _64FF00\PurePerms\PurePerms;

class PPMySQLTask extends Task
{
    private PurePerms $plugin;
    private mysqli $db;

    public function __construct(PurePerms $plugin, mysqli $db)
    {
        $this->plugin = $plugin;
        $this->db = $db;
    }

    public function onRun(): void
    {
        if ($this->db->ping()) {
            $this->plugin->getLogger()->debug("Connected to MySQLi Server");
        } else {
            $this->plugin->getLogger()->debug("[MySQL] Warning: " . $this->db->error);
        }
    }
}
