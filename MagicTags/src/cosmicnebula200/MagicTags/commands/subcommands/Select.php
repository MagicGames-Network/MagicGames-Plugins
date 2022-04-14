<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags\commands\subcommands;

use alvin0319\GroupsAPI\GroupsAPI;
use CortexPE\Commando\BaseSubCommand;
use cosmicnebula200\MagicTags\MagicTags;
use cosmicnebula200\MagicTags\listeners\types\TagChangeEvent;
use cosmicnebula200\MagicTags\Utils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player as P;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class Select extends BaseSubCommand
{

    public function prepare(): void
    {
        $this->setPermission('magictags.select');
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if (!$sender instanceof P)
            return;
        $form = new SimpleForm(function (P $player, int $data = null): void
        {
           if ($data === null)
               return;
           if ($data == 0)
               return;
           $keys = array_keys(MagicTags::getInstance()->getTags());
           $data--;
           $tag = MagicTags::getInstance()->getTags()[$keys[$data]];
           if (Utils::hasTag($player, $keys[$data]))
           {
               $event = new TagChangeEvent(MagicTags::getInstance()->getPlayerManager()->getPlayer($player)->getCurrentTag(), $keys[$data]);
               $nametag = GroupsAPI::getInstance()->getNameTagFormat(GroupsAPI::getInstance()->getGroupManager()->getGroup(GroupsAPI::getInstance()->getMemberManager()->getMember($player->getName())->getHighestGroup() ?? GroupsAPI::getInstance()->getDefaultGroups()[0]));
               MagicTags::getInstance()->getPlayerManager()->getPlayer($player)->setCurrentTag($keys[$data]);
               $event->call();
               $nametag = str_replace('{TAG}', $tag["Name"], $nametag);
               $player->setNameTag($nametag);
               $player->sendMessage(MagicTags::getInstance()->formatMessage('selected-tag', [
                   "tag_name" => $tag["Name"],
                   "nametag" => $player->getNameTag()
               ]));
           }
        }); 
        $form->addButton("§l§4Close [X]");
        $rt = MagicTags::getInstance()->getTags();
        $tags = array_keys($rt);
        foreach($tags as $tag)
        {
            $owned = "§l§cNot Owned";
            if (Utils::hasTag($sender, $tag))
                $owned = "§l§aOwned";
            $form->addButton($rt[$tag]["Display"] . "\n" . $owned);
        }
        $form->setTitle(TextFormat::colorize(MagicTags::getInstance()->getConfig()->get('form-title')));
        $form->sendToPlayer($sender);
    }

}
