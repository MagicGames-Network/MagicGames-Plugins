<?php

namespace Pushkar\MagicCore\forms\nick;

use pocketmine\player\Player;
use pocketmine\Server;
use Pushkar\MagicCore\MagicCore;
use dktapps\pmforms\CustomForm;
use dktapps\pmforms\element\Input;
use Pushkar\MagicCore\utils\Utils;
use dktapps\pmforms\CustomFormResponse;

class NickChangeForm extends CustomForm
{

    public function __construct()
    {
        parent::__construct(
            "§6§l«§r §eNickname Menu §6§l»§r",
            [
                new Input("element0", "§6Type the nickname that u want here:", "§7Nickname...")
            ],
            function (Player $player, CustomFormResponse $response): void {
                $nickName = $response->getString("element0");
                if ($nickName == "reset") {
                    (new Utils())->resetNick($player);
                }
                if (strlen($nickName) > 15) {
                    $player->sendMessage("§l§eMAGICGAMES > §r§bYou Can Make Nickname Only In Less Than 9 Characters!");
                    return;
                }
                $dataPath = MagicCore::getInstance()->getServer()->getDataPath();
                if (file_exists($dataPath . "players/" . $nickName)){
                    $player->sendMessage("§l§eMAGICGAMES > §r§bYou Can't Make NickName Of Any GameTag!");
                    return;
                }
                $player->setDisplayName($nickName);
                $player->setNameTag($nickName);
                $player->sendMessage(" §7Your nickname is now §c" . $nickName);
            }
        );
    }
}
