<?php

namespace blueturk\skyblock\managers;


use blueturk\skyblock\forms\island\partner\PartnerRequestForm;
use blueturk\skyblock\SkyBlock;
use pocketmine\player\Player;
use pocketmine\Server;

class IslandManager
{

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function islandVisit(Player $player, string $selectedPlayer): void
    {
        $selectedPlayer = Server::getInstance()->getPlayerExact($selectedPlayer);
        if (!$selectedPlayer instanceof Player) {
            $player->sendMessage(SkyBlock::BT_MARK . "cThe player is not active, you cannot visit!");
            return;
        }
        if (!Server::getInstance()->getWorldManager()->isWorldLoaded($selectedPlayer->getName())) Server::getInstance()->getWorldManager()->loadWorld($selectedPlayer->getName());
        $player->teleport(Server::getInstance()->getWorldManager()->getWorldByName($selectedPlayer->getName())->getSpawnLocation());
        $player->sendMessage(SkyBlock::BT_MARK . "bYou visited the island!");
        $selectedPlayer->sendMessage(SkyBlock::BT_MARK . "b" . $player->getName() . " The player visited the island!");
        return;
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function partnerRemove(Player $player, string $selectedPlayer)
    {
        $array = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".this-partners");
        $array2 = SkyBlock::getInstance()->getConfig()->getNested($selectedPlayer . ".island" . ".other-partners");
        unset($array[array_search($selectedPlayer, $array)]);
        unset($array2[array_search($player->getName(), $array2)]);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".this-partners", $array);
        SkyBlock::getInstance()->getConfig()->setNested($selectedPlayer . ".island" . ".other-partners", $array2);
        $player->sendMessage(SkyBlock::BT_MARK . "bYou unaffiliated the player!");
        $selectedPlayer = Server::getInstance()->getPlayerExact($selectedPlayer);
        if ($selectedPlayer instanceof Player) {
            $selectedPlayer->sendMessage(SkyBlock::BT_MARK . "b" . $player->getName() . " The player removed you from the partnership!");
        }
    }

    /**
     * @param Player $player
     * @param string $requestPlayer
     */
    public static function partnerRequestConfirm(Player $player, string $requestPlayer)
    {
        $requestPlayer = Server::getInstance()->getPlayerExact($requestPlayer);
        if ($requestPlayer instanceof Player) {
            $array = SkyBlock::getInstance()->getConfig()->getNested($requestPlayer->getName() . ".island" . ".this-partners");
            if (!in_array($player->getName(), $array)) {
                array_push($array, $player->getName());
                SkyBlock::getInstance()->getConfig()->setNested($requestPlayer->getName() . ".island" . ".this-partners", $array);
                if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island") != null) {
                    $array1 = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".other-partners");
                    array_push($array1, $requestPlayer->getName());
                    SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".other-partners", $array1);
                } else {
                    $array1 = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".partners");
                    array_push($array1, $requestPlayer->getName());
                    SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".partners", $array1);
                }
                $player->sendMessage(SkyBlock::BT_MARK . "bYou accepted the partnership offer!");
                $requestPlayer->sendMessage(SkyBlock::BT_MARK . "bPartnership accepted your offer!");
            } else {
                $requestPlayer->sendMessage(SkyBlock::BT_MARK . "cThis player is already your partner!");
            }
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cThe player is not active!");
        }
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function partnerRequest(Player $player, string $selectedPlayer): void
    {
        $selectedPlayer = Server::getInstance()->getPlayerExact($selectedPlayer);
        if ($selectedPlayer instanceof Player) {
            if ($selectedPlayer->getName() === $player->getName()) {
                $player->sendMessage(SkyBlock::BT_MARK . "cYou cannot add yourself as a partner!");
                return;
            }
            $array = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".this-partners");
            if (in_array($selectedPlayer->getName(), $array)) {
                $player->sendMessage(SkyBlock::BT_MARK . "cThis player is already your partner!");
                return;
            }
            $selectedPlayer->sendForm(new PartnerRequestForm($player));
            $player->sendMessage(SkyBlock::BT_MARK . "b" . $selectedPlayer->getName() . " Partnership request has been sent to player!");
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cThe player is not active!");
        }
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function islandUnBanPlayer(Player $player, string $selectedPlayer)
    {
        $array = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".banneds");
        unset($array[array_search($selectedPlayer, $array)]);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".banneds", $array);
        $player->sendMessage(SkyBlock::BT_MARK . "bYou've unbanned the player!");
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function islandBanPlayer(Player $player, string $selectedPlayer)
    {
        $selectedPlayer = Server::getInstance()->getPlayerExact($selectedPlayer);
        if ($selectedPlayer instanceof Player) {
            $array = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".banneds");
            array_push($array, $selectedPlayer->getName());
            SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".banneds", $array);
            $selectedPlayer->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSpawnLocation());
            $selectedPlayer->sendMessage(SkyBlock::BT_MARK . "cYou are banned from the island!");
            $player->sendMessage(SkyBlock::BT_MARK . "bYou banned the player!");
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cThe player is not active!");
        }
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function islandKickPlayer(Player $player, string $selectedPlayer): void
    {
        $selectedPlayer = Server::getInstance()->getPlayerExact($selectedPlayer);
        if ($selectedPlayer instanceof Player) {
            if ($selectedPlayer->getName() === $player->getName()) {
                $player->sendMessage(SkyBlock::BT_MARK . "bYou can't clean yourself!");
                return;
            }
            $selectedPlayer->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSpawnLocation());
            $selectedPlayer->sendMessage(SkyBlock::BT_MARK . "cYou've been kicked off the island!");
            $player->sendMessage(SkyBlock::BT_MARK . "bPlayer kicked!");
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cThe player is not active!");
        }
    }

    /**
     * @param Player $player
     * @param string $selectedPlayer
     */
    public static function teleportPartnerIsland(Player $player, string $selectedPlayer)
    {
        $selectedPlayers = Server::getInstance()->getPlayerExact($selectedPlayer);
        if ($selectedPlayers instanceof Player) {
            if (!Server::getInstance()->getWorldManager()->isWorldLoaded($selectedPlayers->getName())) Server::getInstance()->getWorldManager()->loadWorld($selectedPlayers->getName());
            $level = Server::getInstance()->getWorldManager()->getWorldByName($selectedPlayers->getName());
            $player->teleport($level->getSpawnLocation());
            $player->sendMessage(SkyBlock::BT_MARK . "bTeleported to partner island!");
        } else {
            $status = SkyBlock::getInstance()->getConfig()->getNested($selectedPlayer . ".island" . ".settings" . ".de-active-teleport");
            if ($status === true) {
                if (!Server::getInstance()->getWorldManager()->isWorldLoaded($selectedPlayer)) Server::getInstance()->getWorldManager()->loadWorld($selectedPlayer);
                $level = Server::getInstance()->getWorldManager()->getWorldByName($selectedPlayer);
                $player->teleport($level->getSpawnLocation());
                $player->sendMessage(SkyBlock::BT_MARK . "bTeleported to partner island!");
            } elseif ($status === false) {
                $player->sendMessage(SkyBlock::BT_MARK . "cYou cannot teleport to your island while your partner is inactive!");
            } else {
                $player->sendMessage(SkyBlock::BT_MARK . "cYour partner has deleted their island!");
            }
        }
    }

    /**
     * @param Player $player
     * @param bool $interact
     * @param bool $place
     * @param bool $break
     * @param bool $pickingUp
     * @param bool $deActiveTeleport
     */
    public static function changePartnerSettings(Player $player, bool $interact, bool $place, bool $break, bool $pickingUp, bool $deActiveTeleport)
    {
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".settings" . ".interact", $interact);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".settings" . ".place", $place);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".settings" . ".break", $break);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".settings" . ".picking-up", $pickingUp);
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".island" . ".settings" . ".de-active-teleport", $deActiveTeleport);
        $player->sendMessage(SkyBlock::BT_MARK . "bPartner settings saved!");
    }

    /**
     * @param Player $player
     */
    public static function teleportToIsland(Player $player)
    {
        if (!Server::getInstance()->getWorldManager()->isWorldLoaded($player->getName())) Server::getInstance()->getWorldManager()->loadWorld($player->getName());
        $level = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        $player->teleport($level->getSpawnLocation());
        $player->sendMessage(SkyBlock::BT_MARK . "bYou've been teleported to Adana!");
    }

    /**
     * @param Player $player
     */
    public static function setIslandSpawnLocation(Player $player)
    {
        if ($player->getWorld()->getFolderName() === $player->getName()) {
            $player->getWorld()->setSpawnLocation($player->getPosition()->asVector3());
            $player->sendMessage(SkyBlock::BT_MARK . "bIsland center set!!");
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cYou can only do this on your island!");
        }
    }

    /**
     * @param Player $player
     * @param bool $status
     */
    public static function changeIslandVisit(Player $player, bool $status)
    {
        if ($status === true) {
            SkyBlock::getInstance()->getConfig()->setNested("Visits." . $player->getName(), false);
            $player->sendMessage(SkyBlock::BT_MARK . "bVisit set to closed!");
        } elseif ($status === false) {
            SkyBlock::getInstance()->getConfig()->setNested("Visits." . $player->getName(), true);
            $player->sendMessage(SkyBlock::BT_MARK . "bVisit is set to open!");
        } else {
            $player->sendMessage(SkyBlock::BT_MARK . "cAn unknown error has occurred, report it to the authorized team!");
        }
    }

    /**
     * @param Player $player
     * @param string $islandType
     */
    public static function islandCreate(Player $player, string $islandType)
    {
        #Copy Island Word
        $dataPath = SkyBlock::getInstance()->getServer()->getDataPath();
        @mkdir($dataPath . "worlds/" . $player->getName() . "/");
        @mkdir($dataPath . "worlds/" . $player->getName() . "/db/");
        $world = opendir(SkyBlock::getInstance()->getServer()->getDataPath() . $islandType . "/db/");
        while ($file = readdir($world)) {
            if ($file != "." and $file != "..") {
                copy($dataPath . $islandType . "/db/" . $file, $dataPath . "worlds/" . $player->getName() . "/db/" . $file);
            }
        }
        copy($dataPath . $islandType . "/level.dat", $dataPath . "worlds/" . $player->getName() . "/level.dat");
        #Create YAML Data
        $data = SkyBlock::getInstance()->getConfig();
        $deleteTime = $data->getNested($player->getName() . ".delete-time");
        $partners = $data->getNested($player->getName() . ".partners");
        if ($partners === null) $partners = [];
        if ($deleteTime === null) $deleteTime = null;
        $data->setNested($player->getName() . ".island", [
            "settings" => [
                "interact" => false,
                "place" => false,
                "break" => false,
                "picking-up" => false,
                "de-active-teleport" => false,
                "delete-time" => $deleteTime
            ],
            "banneds" => [],
            "this-partners" => [],
            "other-partners" => $partners
        ]);
        $data->setNested("Visits." . $player->getName(), false);
        #Teleporting
        Server::getInstance()->getWorldManager()->loadWorld($player->getName());
        $player->teleport(Server::getInstance()->getWorldManager()->getWorldByName($player->getName())->getSpawnLocation());
        $player->getWorld()->requestChunkPopulation($player->getPosition()->getFloorX() >> 4, $player->getPosition()->getFloorZ() >> 4,null);
        $player->sendMessage(SkyBlock::BT_MARK . "bYour island has been created, you are being teleporting!");
    }

    /**
     * @param Player $player
     */
    public static function islandRemove(Player $player): void
    {
        if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".delete-time") === null){
            $deleteTime = null;
        }else{
            $deleteTime = SkyBlock::getInstance()->getConfig()->getNested($player->getName())["delete-time"];
        }
        var_dump($deleteTime);
        if ($deleteTime === null) {
            var_dump($deleteTime);
            self::islandDataDelete($player);
        } else {
            if (time() > (int)$deleteTime) {
                self::islandDataDelete($player);
            } else {
                $deleteTime = $deleteTime - time();
                $day = floor($deleteTime / 86400);
                $hourSecond = $deleteTime % 86400;
                $hour = floor($hourSecond / 3600);
                $minuteHour = $hourSecond % 3600;
                $minute = floor($minuteHour / 60);
                $player->sendMessage(SkyBlock::BT_MARK . "fYou have to wait §6". $day . " §fday, §6" . $hour . " §fhour, §6" . $minute . " §fTo be able to delete your island!");
            }
        }
    }

    public static function islandDataDelete(Player $player){
        $level = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        if ($level->getPlayers() != null) {
            foreach ($level->getPlayers() as $islandPlayer) {
                $islandPlayer->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSpawnLocation());
                $islandPlayer->sendMessage(SkyBlock::BT_MARK . "bThe island you are on is being deleted..");
            }
        }
        $old = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".this-partners");
        if ($old != null) {
            foreach ($old as $value) {
                $array = SkyBlock::getInstance()->getConfig()->getNested($value . ".island" . ".other-partners");
                if ($array != null) {
                    unset($array[array_search($player->getName(), $array)]);
                    SkyBlock::getInstance()->getConfig()->setNested($value . ".island" . ".other-partners", $array);
                } else {
                    $array = SkyBlock::getInstance()->getConfig()->getNested($value . ".partners");
                    unset($array[array_search($player->getName(), $array)]);
                    SkyBlock::getInstance()->getConfig()->setNested($value . ".partners", $array);
                }
            }
        }
        $old2 = SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".other-partners");
        if ($old2 != null) {
            foreach ($old2 as $value) {
                $array = SkyBlock::getInstance()->getConfig()->getNested($value . ".island" . ".this-partners");
                if ($array != null) {
                    unset($array[array_search($player->getName(), $array)]);
                    SkyBlock::getInstance()->getConfig()->setNested($value . ".island" . ".this-partners", $array);
                }
            }
        }
        $world = Server::getInstance()->getWorldManager()->getWorldByName($player->getName());
        Server::getInstance()->getWorldManager()->unloadWorld($world);
        $world = SkyBlock::getInstance()->getServer()->getDataPath() . "/worlds/" . $player->getName();
        self::worldDelete($world);
        SkyBlock::getInstance()->getConfig()->removeNested($player->getName() . ".island");
        SkyBlock::getInstance()->getConfig()->removeNested("Visits." . $player->getName());
        SkyBlock::getInstance()->getConfig()->setNested($player->getName() . ".delete-time", (time() + 7 * 86400));
        $player->sendMessage(SkyBlock::BT_MARK . "bYou have successfully deleted your island!");
    }

    public static function worldDelete(string $world): int
    {
        $file = 1;
        if (basename($world) == "." || basename($world) == "..") {
            return 0;
        }
        foreach (scandir($world) as $item) {
            if ($item != "." || $item != "..") {
                if (is_dir($world . DIRECTORY_SEPARATOR . $item)) {
                    $file += self::worldDelete($world . DIRECTORY_SEPARATOR . $item);
                }
                if (is_file($world . DIRECTORY_SEPARATOR . $item)) {
                    $file += unlink($world . DIRECTORY_SEPARATOR . $item);
                }
            }
        }
        rmdir($world);
        return $file;
    }
}