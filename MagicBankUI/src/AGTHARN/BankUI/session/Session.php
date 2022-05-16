<?php

namespace AGTHARN\BankUI\session;

use pocketmine\Server;
use AGTHARN\BankUI\Main;
use libMarshal\MarshalTrait;
use pocketmine\player\Player;
use AGTHARN\BankUI\bank\Banks;
use libMarshal\attributes\Field;
use onebone\economyapi\EconomyAPI;

abstract class Session
{
    use MarshalTrait;

    public ?Player $player = null;
    public string $fileName;

    #[Field]
    public string $name = "";
    #[Field(name: "bank-provider")]
    public string $bankProvider = "";
    #[Field(name: "bank-activate-time")]
    public int $bankActivateTime = 0;
    #[Field(name: "last-closed-time")]
    public int $lastClosedTime = 0;
    #[Field]
    public float $money = 0.00;

    #[Field(name: "transaction-logs")]
    public array $transactionLogs = [];

    #[Field]
    public bool $frozen = false;
    #[Field]
    public bool $allowed = false;

    public function saveData(): int|false
    {
        return $this->saveToJson($this->fileName);
    }

    public function loadData(): void
    {
        if (!file_exists($this->fileName)) {
            $this->resetData();
            return;
        }
        $data = self::loadFromJson($this->fileName)->marshal();

        $this->bankProvider = $data["bank-provider"];
        $this->bankActivateTime = $data["bank-activate-time"];
        $this->lastClosedTime = $data["last-closed-time"];
        $this->money = $data["money"];
        $this->transactionLogs = $data["transaction-logs"];
        $this->frozen = $data["frozen"];
        $this->allowed = $data["allowed"];
    }

    public function resetData(): void
    {
        $this->bankProvider = "";
        $this->bankActivateTime = 0;
        $this->lastClosedTime = time();
        $this->money = 0.00;
        $this->transactionLogs = [];
        $this->frozen = false;
        $this->allowed = false;
        if (is_bool($this->saveData())) {
            $this->handleKick("MagicBankUI: Failed to reset data. Please report this immediately!");
            return;
        }
    }

    public function setBank(string $bankName): bool
    {
        if (Banks::bankExists($bankName)) {
            $this->bankProvider = $bankName;
            $this->bankActivateTime = time();
            $this->money = Banks::getBankData($bankName)["startingMoney"];
            $this->saveData();

            $this->handleMessage(" §aSuccessfully applied for a bank account with $bankName! You may run the command again to check your application status!");
            return true;
        }
        return false;
    }

    public function isBankActivated(): bool
    {
        if (Banks::bankExists($this->bankProvider)) {
            return $this->bankActivateTime + Banks::getBankData($this->bankProvider)["approvalSeconds"] < time();
        }
        return false;
    }

    public function hasBank(): bool
    {
        return $this->bankProvider !== "";
    }

    public function addMoney(mixed $amount): void
    {
        if (!is_numeric($amount)) {
            $this->handleMessage(" §cError encountered - Amount added is not numeric! $amount given!");
            return;
        }
        $amount = (float) $amount;

        $this->money += $amount;
        $this->saveData();
    }

    public function removeMoney(mixed $amount): void
    {
        if (!is_numeric($amount)) {
            $this->handleMessage(" §cError encountered - Amount added is not numeric! $amount given!");
            return;
        }
        $amount = (float) $amount;

        $this->money -= $amount;
        $this->saveData();
    }

    public function depositMoney(mixed $amount): bool
    {
        if (!is_numeric($amount)) {
            $this->handleMessage(" §cError encountered - Amount added is not numeric! $amount given!");
            return false;
        }
        $depositTax = Banks::getBankData($this->bankProvider)["depositTax"];
        $amount = (float) ($amount + $depositTax);

        if ($amount < 100.00) {
            $this->handleMessage(" §cError encountered - Deposit amount must be greater than 100! $amount given!");
            return false;
        }
        if (EconomyAPI::getInstance()->myMoney($this->player ?? $this->name) < $amount) {
            $this->handleMessage(" §cYou do not have enough money to deposit this amount! $amount given!");
            return false;
        }
        if (!$this->allowed && $amount >= Banks::MONEY_LIMIT) {
            $this->handleMessage(" §cA large money transfer has been detected! Your bank account has been frozen by the authorities! Please create a ticket on our Discord server to appeal! $amount given!");
            $this->frozen = true;
            return false;
        }

        if (($status = EconomyAPI::getInstance()->reduceMoney($this->player ?? $this->name, $amount, true, "BANKUI")) === EconomyAPI::RET_SUCCESS) {
            $this->money += $amount;
            if (is_bool($this->saveData())) {
                $this->handleKick("MagicBankUI: Failed to save when depositing money. Please report this immediately!");
                return false;
            }
            $this->transactionLogs[] = [
                "time" => time(),
                "date" => date("§b[d/m/y]"),
                "type" => Banks::TRANSACTION_TYPE_DEPOSIT,
                "amount" => $amount,
                "balanceBefore" => $this->money - $amount,
                "balanceAfter" => $this->money
            ];
            $this->saveData();

            $this->handleMessage(" §aSuccessfully deposited §f$" . number_format($amount, 2) . "§a into your bank account! Taxes: §f$" . $depositTax);
            return true;
        }
        $this->handleMessage(" §cError encountered - CODE ERROR: $status!");
        return false;
    }

    public function withdrawMoney(mixed $amount): bool
    {
        if (!is_numeric($amount)) {
            $this->handleMessage(" §cError encountered - Amount added is not numeric! $amount given!");
            return false;
        }
        $withdrawTax = Banks::getBankData($this->bankProvider)["withdrawTax"];
        $amount = (float) ($amount + $withdrawTax);

        if ($amount < 100.00) {
            $this->handleMessage(" §cError encountered - Deposit amount must be greater than 100! $amount given!");
            return false;
        }
        if ($this->money < $amount) {
            $this->handleMessage(" §cYou do not have enough money in your bank account to withdraw this amount! $amount given!");
            return false;
        }
        if (!$this->allowed && $amount >= Banks::MONEY_LIMIT) {
            $this->handleMessage(" §cA large money transfer has been detected! Your bank account has been frozen by the authorities! Please create a ticket on our Discord server to appeal! $amount given!");
            $this->frozen = true;
            return false;
        }

        if (($status = EconomyAPI::getInstance()->addMoney($this->player ?? $this->name, $amount, true, "BANKUI")) === EconomyAPI::RET_SUCCESS) {
            $this->money -= $amount;
            if (is_bool($this->saveData())) {
                $this->handleKick("MagicBankUI: Failed to save when withdrawing money. Please report this immediately!");
                return false;
            }
            $this->transactionLogs[] = [
                "time" => time(),
                "date" => date("§b[d/m/y]"),
                "type" => Banks::TRANSACTION_TYPE_WITHDRAW,
                "amount" => $amount,
                "balanceBefore" => $this->money + $amount,
                "balanceAfter" => $this->money
            ];
            $this->saveData();

            $this->handleMessage(" §aSuccessfully withdrew §f$" . number_format($amount, 2) . "§a from your bank account! Taxes: §f$" . $withdrawTax);
            return true;
        }
        $this->handleMessage(" §cError encountered - CODE ERROR: $status!");
        return false;
    }

    public function transferMoney(mixed $amount, string $receiverName): bool
    {
        if (!is_numeric($amount)) {
            $this->handleMessage(" §cError encountered - Amount added is not numeric! $amount given!");
            return false;
        }
        $transferTax = Banks::getBankData($this->bankProvider)["transferTax"];
        $amount = (float) ($amount + $transferTax);

        if ($amount < 100.00) {
            $this->handleMessage(" §cError encountered - Deposit amount must be greater than 100! $amount given!");
            return false;
        }
        if ($this->money < $amount) {
            $this->handleMessage(" §cYou do not have enough money in your bank account to transfer this amount! $amount given!");
            return false;
        }
        if (!$this->allowed && $amount >= Banks::MONEY_LIMIT) {
            $this->handleMessage(" §cA large money transfer has been detected! Your bank account has been frozen by the authorities! Please create a ticket on our Discord server to appeal! $amount given!");
            $this->frozen = true;
            return false;
        }

        if (($receiver = Server::getInstance()->getPlayerByPrefix($receiverName)) instanceof Player) {
            $this->money -= $amount;
            if (is_bool($this->saveData())) {
                $this->handleKick("MagicBankUI: Failed to save when transferring money. Please report this immediately!");
                return false;
            }
            $this->transactionLogs[] = [
                "time" => time(),
                "date" => date("§b[d/m/y]"),
                "type" => Banks::TRANSACTION_TYPE_TRANSFER,
                "amount" => $amount,
                "receiver" => $receiverName,
                "balanceBefore" => $this->money + $amount,
                "balanceAfter" => $this->money
            ];

            Main::getInstance()->getSessionManager()->getSession($receiver)->addMoney($amount);
            $this->handleMessage(" §aSuccessfully transferred §f$" . number_format($amount, 2) . "§a to $receiverName! Taxes: §f$" . $transferTax);
            return true;
        }
        if (is_file(Main::getInstance()->getDataFolder() . "data/" . $receiverName . ".json")) {
            $this->money -= $amount;
            if (is_bool($this->saveData())) {
                $this->handleKick("MagicBankUI: Failed to save when transferring money. Please report this immediately!");
                return false;
            }
            $this->transactionLogs[] = [
                "time" => time(),
                "date" => date("§b[d/m/y]"),
                "type" => Banks::TRANSACTION_TYPE_TRANSFER,
                "amount" => $amount,
                "balanceBefore" => $this->money + $amount,
                "balanceAfter" => $this->money
            ];

            $receiverSession = Main::getInstance()->getSessionManager()->getSession($receiverName);
            $receiverSession->addMoney($amount);
            $receiverSession->remove();

            $this->handleMessage(" §aSuccessfully transferred §f$" . number_format($amount, 2) . "§a to $receiverName! Taxes: §f$" . $transferTax);
            return true;
        }
        $this->handleMessage(" §cError encountered - Player does not exist! $receiverName given!");
        return false;
    }

    public function getInterestAmount(): float
    {
        if (Banks::bankExists($this->bankProvider)) {
            return $this->money * Banks::getBankData($this->bankProvider)["interestRate"];
        }
        return 0.00;
    }

    public function handleKick(string $message): bool
    {
        if ($this->player instanceof Player) {
            $this->player->kick($message);
            return true;
        }
        return false;
    }

    public function handleMessage(string $message): bool
    {
        if ($this->player instanceof Player) {
            $this->player->sendMessage($message);
            return true;
        }
        return false;
    }

    public function remove(): void
    {
        $this->saveData();
        Main::getInstance()->getSessionManager()->removeSession($this->player ?? $this->name);
    }
}
