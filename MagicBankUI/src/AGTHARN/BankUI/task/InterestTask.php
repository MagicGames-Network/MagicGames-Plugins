<?php

namespace AGTHARN\BankUI\task;

use AGTHARN\BankUI\Main;
use pocketmine\scheduler\Task;
use AGTHARN\BankUI\session\SessionManager;

class InterestTask extends Task
{
    public function onRun(): void
    {
        foreach (Main::getInstance()->getSessionManager()->getSessions(SessionManager::SESSION_TYPE_PLAYER) as $playerSession) {
            $playerSession->handleMessage(" §aYour hourly bank interest has been added to your account!");
            $playerSession->addInterest();
        }
    }
}
