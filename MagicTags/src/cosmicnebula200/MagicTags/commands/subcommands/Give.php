<?php

declare(strict_types=1);
namespace cosmicnebula200\MagicTags\commands\subcommands;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use cosmicnebula200\MagicTags\MagicTags;
use cosmicnebula200\MagicTags\Utils;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player as P;
use pocketmine\utils\TextFormat;

class Give extends BaseSubCommand
{

    public function prepare(): void
    {
        $this->setPermission('magictags.give');
        try{
            $this->registerArgument(0, new RawStringArgument('tag', false));
            $this->registerArgument(1, new RawStringArgument('player', true));
        }catch (ArgumentOrderException){

        }
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $player = $sender;
        if(isset($args['player']))
            $player = MagicTags::getInstance()->getServer()->getPlayerByPrefix($args['player']);
        if (!$player instanceof P)
            return;
        if (!Utils::checkTag($args['tag']))
        {
            $sender->sendMessage(MagicTags::getInstance()->getMessages()->get('prefix') . " That tag does not exists");
            return;
        }
        $item = ItemFactory::getInstance()->get(MagicTags::getInstance()->getConfig()->get("item-id"), 0);
        $item->setCustomName(TextFormat::colorize(str_replace("{tag_name}", $args["tag"], MagicTags::getInstance()->getConfig()->get('item-name'))));
        $lore = [];
        foreach (MagicTags::getInstance()->getConfig()->get('item-lore') as $l)
        {
            $lore[] = TextFormat::colorize(str_replace("{tag_name}", $args["tag"], $l));
        }
        $item->setLore($lore);
        $item->getNamedTag()->setString('MagicTags', $args['tag']);
        $player->getInventory()->addItem($item);
        if($player !== $sender){
            $player->sendMessage(MagicTags::getInstance()->formatMessage("given-tag", [
                "player" => $player,
                "tag_name" => $args['tag']
            ]));
        }
        $sender->sendMessage(MagicTags::getInstance()->formatMessage("receive-tag", [
            "tag_name" => $args['tag']
        ]));
    }

}
