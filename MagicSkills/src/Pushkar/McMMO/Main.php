<?php

#███╗░░░███╗░█████╗░░██████╗░██╗░█████╗░░██████╗░░█████╗░███╗░░░███╗███████╗░██████╗
#████╗░████║██╔══██╗██╔════╝░██║██╔══██╗██╔════╝░██╔══██╗████╗░████║██╔════╝██╔════╝
#██╔████╔██║███████║██║░░██╗░██║██║░░╚═╝██║░░██╗░███████║██╔████╔██║█████╗░░╚█████╗░
#██║╚██╔╝██║██╔══██║██║░░╚██╗██║██║░░██╗██║░░╚██╗██╔══██║██║╚██╔╝██║██╔══╝░░░╚═══██╗
#██║░╚═╝░██║██║░░██║╚██████╔╝██║╚█████╔╝╚██████╔╝██║░░██║██║░╚═╝░██║███████╗██████╔╝
#╚═╝░░░░░╚═╝╚═╝░░╚═╝░╚═════╝░╚═╝░╚════╝░░╚═════╝░╚═╝░░╚═╝╚═╝░░░░░╚═╝╚══════╝╚═════╝░

namespace Pushkar\McMMO;

#use Pushkar\McMMO\entity\FloatingText;
use Pushkar\McMMO\form\McmmoForm;
use pocketmine\block\Solid;
use pocketmine\entity\Entity;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\entity\EntityFactory;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\math\Vector3;
use pocketmine\block\BlockLegacyIds as BlockIds;
use pocketmine\item\ItemIds;
use _64FF00\PurePerms\DataManager\UserDataManager;
use _64FF00\PurePerms\PPGroup;
use _64FF00\PurePerms\PurePerms;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
use pocketmine\level\sound\AnvilUseSound;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\console\ConsoleCommandSender;

class Main extends PluginBase implements Listener
{

    public const LUMBERJACK = 0;
    public const FARMER = 1;
    public const MINER = 3;
    public const EXCAVATION = 2;
    public const COMBAT = 5;
    public const KILLER = 4;
    public const BUILDER = 6;
    public const CONSUMER = 7;
    public const ARCHER = 8;
    public const LAWN_MOWER = 9;


    /** @var array */
    public $database;

    /** @var Main */
    public static $instance;

    public function onEnable(): void
    {
        $this->saveResource("database.yml");
        $this->database = yaml_parse(file_get_contents($this->getDataFolder() . "database.yml"));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        #EntityFactory::register(FloatingText::class, true);
        self::$instance = $this;
        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    }
    public function onCommand(CommandSender $sender, Command $command, String $label, Array $args): bool{
    	switch ($command->getName()){
    		case "profile":
    		    if($sender instanceof Player) {
                    	    (new McmmoForm($this))->init($sender);
                    } else {
                           $sender->sendMessage("Use this command in-game");
                            return true;
                    }
            break;
            /*case "mcmmoadmin":
                if(!$sender instanceof Player) {
                    $sender->sendMessage("Please use command in-game");
                    return true;
                }
                if(!$sender->isOp()) {
                    $sender->sendMessage("You not op on this server");
                    return true;
                }
                $a = ["lumberjack", "farmer", "excavation", "miner", "killer", "combat", "builder", "consumer", "archer", "lawnmower"];
                if(count($args) === 0) {
                    $sender->sendMessage("Usage: /mcmmoadmin setup ".implode("/" , $a)."> (to spawn floating text) | /mcmmoadmin remove (to remove nearly floating text)");
                    return true;
                }
                if($args[0] === "remove") {
                    $maxDistance = 3;
                    $g = 0;
                    foreach($sender->getLevel()->getNearbyEntities($sender->getBoundingBox()->expandedCopy($maxDistance, $maxDistance, $maxDistance)) as $entity){
                        if($entity instanceof FloatingText) {
                            $g++;
                            $entity->close();
                        }
                    }
                    $sender->sendMessage("Removed ".$g." floating text");
                    return true;
                }
                if($args[0] === "setup") {
                    if(!isset($args[1])) {
                        $sender->sendMessage("Usage: /mcmmoadmin setup ".implode("/" , $a)."> (to spawn floating text)");
                        return true;
                    }
                    if(!in_array($args[1], $a)) {
                        $sender->sendMessage("Usage: /mcmmoadmin setup ".implode("/" , $a)."> (to spawn floating text)");
                        return true;
                    }
                    $nbt = Entity::createBaseNBT($sender->asVector3(), null, $sender->yaw, $sender->pitch);
                    $sender->saveNBT();
                    $nbt->setTag(clone $sender->namedtag->getCompoundTag("Skin"));
                    $a = ["lumberjack" => 0, "farmer" => 1, "excavation" => 2, "miner" => 3, "killer" => 4, "combat" => 5, "builder" => 6, "consumer" => 7, "archer" => 8, "lawnmower" => 9];
                    $nbt->setInt("type", $a[$args[1]]);
                    $entity = new FloatingText($sender->level, $nbt);
                    $entity->spawnToAll();
                }
            break;*/
    	}
    	return true;
    }

    public static function getInstance() : Main {
        return self::$instance;
    }

    public function onDisable(): void
    {
        file_put_contents($this->getDataFolder() . "database.yml", yaml_emit($this->database));
        sleep(3); // save database delay
    }

    public function getXp(int $type, Player $player) : int {
        return $this->database["xp"][$type][strtolower($player->getName())];
    }

    public function getLevel(int $type, Player $player) : int {
        return $this->database["level"][$type][strtolower($player->getName())];
    }

    public function addXp(int $type, Player $player) {
        $this->database["xp"][$type][strtolower($player->getName())]++;
        if($this->database["xp"][$type][strtolower($player->getName())] >= ($this->getLevel($type, $player) * 100)) {
            $this->database["xp"][$type][strtolower($player->getName())] = 0;
            $this->addLevel($type, $player);
        }
       $a = ["Lumberjack ", "Farmer ", "Excavation ", "Miner ", "Killer ", "Combat ", "Builder ", "Consumer ", "Archer ", "Lawn Mower "];
       $player->sendTip("₹§b+1 §d".$a[$type]." §7(§a".$this->getXp($type, $player). "§7)");    
    }

    public function addLevel(int $type, Player $player) {
      
        $this->database["level"][$type][strtolower($player->getName())]++;
        $a = ["Lumberjack", "Farmer", "Excavation", "Miner", "Killer", "Combat", "Builder", "Consumer", "Archer", "Lawn Mower"];
        $health = mt_rand(1, 8);
        $defense = mt_rand(1, 8);
        $player->sendMessage("§3§l========================\n §l§bSKILL LEVEL UP§r§3 " . $a[$type] . "\n\n §l§aREWARDS§r\n   §e". $a[$type] . " " . $this->getLevel($type, $player) . "\n   §8+§6" . $this->getLevel($type, $player) * 1000 . " §7Coins\n   §8+§c  $health Health\n   §8+§a  $defense Defense\n   §8+§4  1 Damage\n§3§l========================");
        if($this->getLevel(self::FARMER, $player) == 2 && $type == self::FARMER){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'portalspe.farm');
          $player->sendMessage("§r§l§eBONUS\n §r§b Farming Island Portal Is Now Unlocked\n§3§l========================");
        }
        if($this->getLevel(self::FARMER, $player) == 3 && $type == self::FARMER){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'portalspe.mushroom');
          $player->sendMessage("§r§l§eBONUS\n §r§b Mushroom Island Portal Is Now Unlocked\n§3§l========================");
        }
        if($this->getLevel(self::LUMBERJACK, $player) == 2 && $type == self::LUMBERJACK){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'portalspe.forest');
          $player->sendMessage("§r§l§eBONUS\n §r§b Forest Island Portal Is Now Unlocked\n§3§l========================");
        }
        if($this->getLevel(self::MINER, $player) == 2 && $type == self::MINER){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'lapis.teleport');
          $player->sendMessage("§r§l§eBONUS\n §r§b Lapis And Redstone Lift Is Now Unlocked\n§3§l========================");
        }
        if($this->getLevel(self::MINER, $player) == 3 && $type == self::MINER){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'diamond.teleport');
          $player->sendMessage("§r§l§eBONUS\n §r§b Diamond And Emerald Lift Is Now Unlocked\n§3§l========================");
        }
        if($this->getLevel(self::MINER, $player) == 4 && $type == self::MINER){
          $purePerms = $this->getServer()->getPluginManager()->getPlugin('PurePerms');
          $purePerms->getUserDataMgr()->setPermission($player, 'obsidian.teleport');
          $player->sendMessage("§r§l§eBONUS\n §r§b Sanctuary Lift Is Now Unlocked\n§3§l========================");
        }
        $player->sendtitle("§6Level Up ", "§e$a[$type]",);
        $cost = ($this->getLevel($type, $player) * 1000);
        $this->eco->addMoney($player, $cost);
        $maxheal = $player->getMaxHealth();
        $adefense = $player->getDefense();
        $adamage = $player->getDamage();
        $x = ($maxheal + $health);
        $y = ($adefense + $defense);
        $z = ($adamage + 1);
        $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), str_replace("{player}", $player->getName(), "hdset \"{player}\" MaxHealth $x"));
        $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), str_replace("{player}", $player->getName(), "hdset \"{player}\" Defense $y"));
        $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), str_replace("{player}", $player->getName(), "hdset \"{player}\" Damage $z"));
    }

    public function getAll(int $type) : array {
        return $this->database["level"][$type];
    }

    public function onLogin(PlayerLoginEvent $event) {
        $player = $event->getPlayer();
        if(!isset($this->database["xp"][0][strtolower($player->getName())])) {
            for($i = 0; $i < 10; $i++) {
                $this->database["xp"][$i][strtolower($player->getName())] = 0;
                $this->database["level"][$i][strtolower($player->getName())] = 1;
            }
        }
    }

    /**
     * @priority LOWEST
     */
    public function onBreak(BlockBreakEvent $event) {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        switch($block->getId()) {
            case BlockIds::WHEAT_BLOCK:
            case BlockIds::BEETROOT_BLOCK:
            case BlockIds::PUMPKIN_STEM:
            case BlockIds::PUMPKIN:
            case BlockIds::MELON_STEM:
            case BlockIds::MELON_BLOCK:
            case BlockIds::CARROT_BLOCK:
            case BlockIds::POTATO_BLOCK:
            case BlockIds::SUGARCANE_BLOCK:
                $this->addXp(self::FARMER, $player);
                return;
            case BlockIds::STONE:
            case BlockIds::DIAMOND_ORE:
            case BlockIds::GOLD_ORE;
            case BlockIds::REDSTONE_ORE:
            case BlockIds::IRON_ORE:
            case BlockIds::COAL_ORE:
            case BlockIds::EMERALD_ORE:
            case BlockIds::OBSIDIAN:
                $this->addXp(self::MINER, $player);
                return;
            case BlockIds::LOG:
            case BlockIds::LOG2:
            case BlockIds::LEAVES:
            case BlockIds::LEAVES2:
                $this->addXp(self::LUMBERJACK, $player);
                return;
            case BlockIds::DIRT:
            case BlockIds::GRASS:
            case BlockIds::GRASS_PATH:
            case BlockIds::FARMLAND:
            case BlockIds::SAND:
            case BlockIds::GRAVEL:
                $this->addXp(self::EXCAVATION, $player);
                return;
            case BlockIds::TALL_GRASS:
            case BlockIds::YELLOW_FLOWER:
            case BlockIds::RED_FLOWER:
            case BlockIds::CHORUS_FLOWER:
                $this->addXp(self::LAWN_MOWER, $player);
                return;
        }
    }

    /**
     * @priority LOWEST
     */
    public function onPlace(BlockPlaceEvent $event) {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if(!$block instanceof Opaque) {
            $this->addXp(self::BUILDER, $player);
            return;
        }
    }

    /**
     * @priority LOWEST
     */
    public function onDamage(EntityDamageEvent $event) {
        if($event->isCancelled()) {
            return;
        }
        if($event->getEntity() instanceof FloatingText) {
            $event->setCancelled();
            return;
        }
        if($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            if(!$entity instanceof Player) return;
            $damager = $event->getDamager();
            if($damager instanceof Player) {
                if (($entity->getHealth() - $event->getFinalDamage()) <= 0) {
                    $this->addXp(self::KILLER, $damager);
                }
                $this->addXp(self::COMBAT, $damager);
            }
        }
    }

    /**
     * @priority LOWEST
     */
    public function onShootBow(EntityShootBowEvent $event) {
        if($event->isCancelled()) {
            return;
        }
        $entity = $event->getEntity();
        if($entity instanceof Player) {
            $this->addXp(self::ARCHER, $entity);
        }
    }

    /**
     * @priority LOWEST
     */
    public function onItemConsume(PlayerItemConsumeEvent $event) {
        if($event->getPlayer()->getHungerManager()->getFood() < $event->getPlayer()->getHungerManager()->getMaxFood()) {
            $this->addXp(self::CONSUMER, $event->getPlayer());
        }
    }
}
