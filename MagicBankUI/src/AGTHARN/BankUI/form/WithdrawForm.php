<?php

namespace AGTHARN\BankUI\form;

use AGTHARN\BankUI\Main;
use pocketmine\player\Player;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;

class WithdrawForm
{
    public static function withdrawForm(Player $player): SimpleForm
    {
        $playerSession = Main::getInstance()->getSessionManager()->getSession($player);
        $coinsAtBank = $playerSession->money;
        $bankName = $playerSession->bankProvider;

        $form = new SimpleForm(function (Player $player, ?int $data = null) use ($playerSession, $coinsAtBank) {
            if ($data === null) {
                return;
            }

            switch ($data) {
                case 0:
                    $playerSession->withdrawMoney($coinsAtBank);
                    break;
                case 1:
                    $playerSession->withdrawMoney($coinsAtBank / 2);
                    break;
                case 2:
                    $player->sendForm(self::withdrawCustomForm($player));
                    break;
                case 3:
                    $player->sendForm(MenuForm::getMenuForm($player));
                    break;
            }
        });

        $form->setTitle("§6» §r§l" . $bankName . " §r§6«");
        $form->setContent("Coins at Bank: §e$$coinsAtBank");
        $form->addButton("§6» §aWithdraw All §6«\n§8Withdraw $coinsAtBank", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§6» §aWithdraw Half §6«\n§8Withdraw " . ($coinsAtBank / 2), 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§6» §aWithdraw Custom §6«\n§8Withdraw Any", 1, "https://cdn-icons-png.flaticon.com/128/2535/2535077.png");
        $form->addButton("§cBack", 1, "textures/blocks/barrier");

        return $form;
    }

    public static function withdrawCustomForm(Player $player): CustomForm
    {
        $playerSession = Main::getInstance()->getSessionManager()->getSession($player);
        $coinsAtBank = $playerSession->money;
        $bankName = $playerSession->bankProvider;

        $form = new CustomForm(function (Player $player, ?array $data = null) use ($playerSession) {
            if ($data === null) {
                return;
            }

            $playerSession->withdrawMoney($data[1]);
        });

        $form->setTitle("§6» §r§l" . $bankName . " §r§6«");
        $form->addLabel("Coins at Bank: §e$$coinsAtBank");
        $form->addInput("Enter amount to withdraw", "100000");

        return $form;
    }
}
