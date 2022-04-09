<?php

namespace Pushkar\MagicCore\forms;

use pocketmine\Server;
use dktapps\pmforms\MenuForm;
use pocketmine\player\Player;
use dktapps\pmforms\MenuOption;

class HideForm extends MenuForm
{

    private array $hide = [];

    public function __construct(Player $player)
    {
        parent::__construct(
            "§l§cPlayer Hide/Un hide",
            "§bPlayer Hide / Un Hide\n\n§bThis Feature Will Reduce Lag On Player Device\n\n§a(§cNote:§a This Function Is Still In Beta You May Can Get Error)",
            [
                new MenuOption("§eHide Status: " . isset($this->hide[$player->getName()]) ? "Hided" : "Un Hided" . "\n§8Click To Change")
            ],
            function (Player $player, int $selected): void {
                if ($selected === 1) {
                    if (isset($this->hide[$player->getName()])) {
                        unset($this->hide[$player->getName()]);
                        foreach (Server::getInstance()->getOnlinePlayers() as $players) {
                            $player->showPlayer($players);
                            $player->sendTitle("§6Done! ", "§eAll Players Are Now Showing");
                        }
                    } else {
                        $this->hide[$player->getName()] = 0;
                        foreach (Server::getInstance()->getOnlinePlayers() as $players) {
                            $player->hidePlayer($players);
                            $player->sendTitle("§6Done! ", "§eAll Players Are Now Hidden");
                        }
                    }
                }
            }
        );
    }
}
