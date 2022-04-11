<?php

declare(strict_types=1);

namespace cosmicnebula200\MagicTags\listeners;

use alvin0319\GroupsAPI\event\PlayerGroupsUpdatedEvent;
use cosmicnebula200\MagicTags\players\Player;
use cosmicnebula200\MagicTags\MagicTags;
use cosmicnebula200\MagicTags\Utils;
use pocketmine\block\BlockLegacyIds as BlockIds;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;

class EventListener implements Listener
{

    /**
     * onRankChange
     *
     * @param PlayerGroupsUpdatedEvent $event
     * @priority NORMAL
     * @return void
     *
     * Sets tag when PurePerms Group changes
     */
    public function onRankChange(PlayerGroupsUpdatedEvent $event): void
    {
        $nameTag = str_replace("{magic_tag}", Utils::getTagName(MagicTags::getInstance()->getPlayerManager()->getPlayer($event->getPlayer())->getCurrentTag()), $event->getPlayer()->getNameTag());
        $event->getPlayer()->setNameTag($nameTag);
    }

    /**
     * onJoin
     *
     * @param PlayerJoinEvent $event
     * @priority HIGHEST
     * @return void
     *
     * adds the tags on join (calls after all the other join events so after pp sets their tag)
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        if (!(MagicTags::getInstance()->getPlayerManager()->getPlayerByName($event->getPlayer()->getName()) instanceof Player))
            MagicTags::getInstance()->getPlayerManager()->createPlayer($event->getPlayer());
        $nameTag = str_replace("{magic_tag}", Utils::getTagName(MagicTags::getInstance()->getPlayerManager()->getPlayer($event->getPlayer())->getCurrentTag()), $event->getPlayer()->getNameTag());
        $event->getPlayer()->setNameTag($nameTag);
    }

    /**
     * onChat
     *
     * @param PlayerChatEvent $event
     * @priority HIGHEST
     * @return void
     *
     * adds tag on chats
     */
    public function onChat(PlayerChatEvent $event): void
    {
        $format = strtolower(str_replace("{TAG}", Utils::getTagName(MagicTags::getInstance()->getPlayerManager()->getPlayer($event->getPlayer())->getCurrentTag()), $event->getFormat()));
        $event->setFormat($format);
    }

    /**
     * onInteract
     *
     * @param PlayerInteractEvent $event
     * @priority HIGHEST
     * @return void
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        if($event->getItem()->getNamedTag()->getTag("MagicTags") == null)
            return;
        if($event->getBlock()->getId() == BlockIds::FRAME_BLOCK)
            $event->cancel();
        if($event->isCancelled())
            return;
        $item = $event->getItem();
        $tag = $item->getNamedTag()->getString("MagicTags");
        if(Utils::hasTag($event->getPlayer(), $tag))
            return;
        MagicTags::getInstance()->getPlayerManager()->getPlayer($event->getPlayer())->addTag($tag);
        $event->getPlayer()->sendMessage(MagicTags::getInstance()->formatMessage('claimed-tag', [
            "tag" => $tag
        ]));
        $item->setCount($item->getCount() - 1);
        $event->getPlayer()->getInventory()->setItemInHand($item);
    }

}
