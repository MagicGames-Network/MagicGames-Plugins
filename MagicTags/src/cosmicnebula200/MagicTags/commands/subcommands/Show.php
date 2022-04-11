<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags\commands\subcommands;

use CortexPE\Commando\BaseSubCommand;
use cosmicnebula200\MagicTags\MagicTags;
use pocketmine\command\CommandSender;
use pocketmine\player\Player as P;

class Show extends BaseSubCommand
{

    public function prepare(): void
    {
        $this->setPermission('magictags.show');
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if(!$sender instanceof P)
        {
            return;
        }
        $tagplayer = MagicTags::getInstance()->getPlayerManager()->getPlayer($sender);
        $tags = implode(", " , $tagplayer->getTags());
        $sender->sendMessage(MagicTags::getInstance()->formatMessage("show-tags", [
            "tag_list" => $tags
        ]));
    }

}
