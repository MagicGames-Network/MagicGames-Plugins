<?php

namespace Pushkar\MagicCore\listener\type;

use pocketmine\Server;
use AGTHARN\BankUI\Main;
use pocketmine\world\World;
use pocketmine\player\Player;
use Stats\player\MagicPlayer;
use pocketmine\event\Listener;
use _64FF00\PurePerms\PurePerms;
use Pushkar\MagicCore\MagicCore;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\math\AxisAlignedBB;
use Pushkar\MagicCore\utils\Utils;
use Pushkar\MagicCore\utils\Configuration;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;

class EntityListener implements Listener
{
    public function onEntityDamage1(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if (!$entity instanceof Player) {
            return;
        }

        if (Configuration::$damageFlyReset) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    if ($damager->isCreative()) return;
                    if ($damager->getAllowFlight() === true) {
                        $damager->sendMessage(MagicCore::PREFIX . "Flight mode disabled due to combat");
                        $damager->setAllowFlight(false);
                        $damager->setFlying(false);
                    }
                }
            }
        }

        if ($event->getCause() === EntityDamageEvent::CAUSE_VOID) {
            $defaultWorld = $entity->getWorld()->getSpawnLocation();
            $entity->teleport($defaultWorld);
            $event->cancel();
            $senderMoney = EconomyAPI::getInstance()->myMoney($entity);
            if (!is_float($senderMoney)) {
                return;
            }
            if (Configuration::$voidLoseMoney) {
                switch (Configuration::$loseMoneyType) {
                    case "all":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($entity, $senderMoney);
                        break;
                    case "half":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . $senderMoney / 2);
                        EconomyAPI::getInstance()->reduceMoney($entity, $senderMoney / 2);
                        break;
                    case "amount":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . Configuration::$moneyLoseAmount);
                        EconomyAPI::getInstance()->reduceMoney($entity, Configuration::$moneyLoseAmount);
                        break;
                    case "percent":
                        $entity->sendMessage("§c§lINFO > §r§bYou Fell In Void And Lost §e$" . (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                        EconomyAPI::getInstance()->reduceMoney($entity, (Configuration::$moneyLoseAmount / 100) * $senderMoney);
                        break;
                }
            }
        }
    }

    /** @priority LOWEST */
    public function onEntityDamage2(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if (!$entity instanceof Player) {
            return;
        }

        $aabb = new AxisAlignedBB(107.00, (float) World::Y_MIN, -74.00, 151.00, (float) World::Y_MAX, -30.00);
        if ($entity->getPosition()->getWorld()->getFolderName() === "MagicGames") {
            if ($aabb->isVectorInXZ($entity->getPosition())) {
                $event->uncancel();
                return;
            }
            $event->cancel();
        }

        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
            $victim = $event->getEntity();
            $level = $victim->getWorld()->getFolderName();
            $worlds = ["test", "Arena"];
            if (
                in_array($level, $worlds) ||
                (!$damager instanceof Player || !$victim instanceof Player) ||
                $damager->getInventory()->getItemInHand()->getId() !== 0
            ) {
                return;
            }
            $event->cancel();

            $form = new SimpleForm(function (Player $player, ?int $result) use ($victim) {
                if ($result === null) return;
                switch ($result) {
                    case 0:
                        $name = $victim->getName();
                        Server::getInstance()->dispatchCommand($player, "visit \"$name\"");
                        break;
                    case 1:
                        $name = $victim->getName();
                        Server::getInstance()->dispatchCommand($player, "trade request \"$name\"");
                        break;
                    case 2:
                        $name = $victim->getName();
                        Server::getInstance()->dispatchCommand($player, "trade accept \"$name\"");
                        break;
                }
            });

            $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
            if ($purePerms instanceof PurePerms) {
                $damage = $victim instanceof MagicPlayer ? $victim->getDamage() : 0;
                $defense = ($victim instanceof MagicPlayer ? $victim->getDefense() : 0) + $victim->getArmorPoints();
                $heal = $victim->getHealth();
                $maxheal = $victim->getMaxHealth();
                $name = $victim->getName();

                $rank = $purePerms->getUserDataMgr()->getData($victim)["group"];
                $coin = EconomyAPI::getInstance()->myMoney($victim);
                $ping = $victim->getNetworkSession()->getPing();
                $bank = Main::getInstance()->getSessionManager()->getSession($victim)->money;
                $device = Utils::getPlayerPlatform($victim);
                $form->setTitle("§l§ePROFILE");
                $form->setContent("§bName:§e $name\n§bPing:§e $ping\n§bRank:§e $rank\n§bMoney In Purse:§e $coin\n§bMoney In Bank:§e $bank\n§bDevice:§e $device\n\n§d§lSTATS:§r\n§7+ §cHealth: $heal" . "§7/§c$maxheal \n§7+ §aDefense: §a$defense \n§7+ §4Damage: $damage ");
                $form->addButton("§l§bVISIT ISLAND\n§l§9»» §r§oTap to visit", 1, "https://i.imgur.com/qt15cyk.png");
                $form->addButton("§l§bREQUEST TRADE\n§l§9»» §r§oTap to request", 1, "https://i.imgur.com/HNAHnLE.png");
                $form->addButton("§l§bACCEPT TRADE\n§l§9»» §r§oTap to request", 1, "https://i.imgur.com/HNAHnLE.png");
                $damager->sendForm($form);
            }
        }
    }

    public function onPlayerTrample(EntityTrampleFarmlandEvent $event): void
    {
        $event->cancel();
    }
}
