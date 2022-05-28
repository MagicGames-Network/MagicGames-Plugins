<?php

namespace Pushkar\MagicCore\listener;

use pocketmine\Server;
use pocketmine\event\Listener;
use Pushkar\MagicCore\MagicCore;
use Pushkar\MagicCore\utils\Utils;

class ListenerManager
{
    public function startup(): void
    {
        Utils::callDirectory("listener" . DIRECTORY_SEPARATOR . "type", function (string $namespace): void {
            $object = new $namespace();
            if ($object instanceof Listener) {
                Server::getInstance()->getPluginManager()->registerEvents($object, MagicCore::getInstance());
            }
        });
    }
}
