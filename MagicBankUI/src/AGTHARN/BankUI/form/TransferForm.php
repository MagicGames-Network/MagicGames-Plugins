<?php

namespace AGTHARN\BankUI\form;

use AGTHARN\BankUI\Main;
use pocketmine\player\Player;
use jojoe77777\FormAPI\CustomForm;

class TransferForm
{
    public static function transferForm(Player $player): CustomForm
    {
        $playerSession = Main::getInstance()->getSessionManager()->getSession($player);
        $coinsAtBank = $playerSession->money;
        $bankName = $playerSession->bankProvider;

        $form = new CustomForm(function (Player $player, ?array $data = null) use ($playerSession) {
            if ($data === null) {
                return;
            }

            $playerSession->transferMoney($data[2], $data[1]);
        });
        
        $form->setTitle("§6» §r§l" . $bankName . " §r§6«");
        $form->addLabel("If the player is offline, please type their name in exact.\n\nCoins at Bank: §e$$coinsAtBank");
        $form->addInput("Enter the Name of the Player");
        $form->addInput("Enter amount to transfer", "100000");
        
        return $form;
    }
}
