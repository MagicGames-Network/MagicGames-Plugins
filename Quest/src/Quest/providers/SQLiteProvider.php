<?php

namespace Quest\providers;

use pocketmine\Server;
use Quest\Quest;
use SQLite3;
use SQLite3Result;
use SQLite3Stmt;

class SQLiteProvider extends Provider
{

    private SQLite3 $database;

    public function __construct()
    {
        try {
            $this->database = new SQLite3(Quest::getInstance()->getDataFolder() . "quest.db");
            $this->database->exec("CREATE TABLE IF NOT EXISTS quest (playerName VARCHAR(40), quest VARCHAR(25), progress INTEGER)");
        }catch (\SQLiteException $exception){
            Quest::getInstance()->getLogger()->error($exception->getMessage());
        }
    }

    public function addQuest(string $playerName,string $quest): void
    {
		/** @var SQLite3Stmt $stmt */
        $stmt = $this->database->prepare("INSERT INTO quest (playerName, quest, progress) VALUES (:playerName, :quest, :progress)");
        $stmt->bindValue(":playerName",$playerName);
        $stmt->bindValue(":quest",$quest);
        $stmt->bindValue(":progress",0);
        $stmt->execute();
    }

    public function removeQuest(string $playerName): void
    {
		/** @var SQLite3Stmt $stmt */
        $stmt = $this->database->prepare("DELETE FROM quest WHERE playerName=:playerName");
        $stmt->bindValue(":playerName",$playerName);
        $stmt->execute();
    }

    public function hasQuest(string $playerName): bool
    {
        $stmt = $this->database->prepare("SELECT * FROM quest WHERE playerName=:playerName");
        $stmt->bindValue(":playerName",$playerName);
        return !empty($stmt->execute()->fetchArray(SQLITE3_ASSOC));
    }

    public function getQuestFromPlayer(string $playerName): array|string
    {
        return $this->database->query("SELECT * FROM quest WHERE playerName='{$playerName}'")->fetchArray(SQLITE3_ASSOC);
    }

    public function updateQuestFromPlayer(string $playerName, int $progress): void {
        $stmt = $this->database->prepare("UPDATE quest SET progress=:progress WHERE playerName=:playerName");
        $stmt->bindValue(":playerName",$playerName);
        $stmt->bindValue(":progress",$progress);
        $stmt->execute();
    }
}
