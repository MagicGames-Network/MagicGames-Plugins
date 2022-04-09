<?php
namespace blueturk\skyblock\forms\island;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\ModalForm;
use pocketmine\player\Player;

class IslandCreateConfirmForm extends ModalForm
{

    public function __construct(string $type)
    {
        parent::__construct(SkyBlock::BT_TITLE . "§bIsland Creation Confirmation", "\n§7How about creating a Island and embarking on a new adventure?\n\n§aIsland Type: §b" . $type . "\n",
            function (Player $player, bool $choice) use ($type): void {
                switch ($choice) {
                    case true:
                        $player->sendMessage(SkyBlock::BT_MARK . "Your island is being created..");
                        if ($type === "BasicIsland") IslandManager::islandCreate($player, "BasicIsland");
                        if ($type === "Beach") IslandManager::islandCreate($player, "Beach");
                        if ($type === "Desert") IslandManager::islandCreate($player, "Desert");
                        if ($type === "Fantasty") IslandManager::islandCreate($player, "Fantasty");
                        if ($type === "Javanese") IslandManager::islandCreate($player, "Javanese");
                        if ($type === "Musroom") IslandManager::islandCreate($player, "Musroom");
                        if ($type === "NetherIsland") IslandManager::islandCreate($player, "NetherIsland");
                        if ($type === "Resort") IslandManager::islandCreate($player, "Resort");
                        if ($type === "Villa") IslandManager::islandCreate($player, "Villa");
                        break;
                    case false:
                        $player->sendForm(new IslandTypeForm());
                        break;
                }
            },
            "Create an Island",
            "< Back"
        );
    }
}
