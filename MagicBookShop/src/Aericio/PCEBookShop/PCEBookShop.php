<?php

declare(strict_types=1);

namespace Aericio\PCEBookShop;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;
use CortexPE\Commando\PacketHooker;
use Aericio\PCEBookShop\utils\Utils;
use Aericio\PCEBookShop\commands\BookShopCommand;
use DaPigGuy\PiggyCustomEnchants\CustomEnchantManager;

class PCEBookShop extends PluginBase
{
    private static PCEBookShop $instance;

    private Config $messages;

    public EconomyAPI $economyProvider;

    /** @var array */
    public array $enchantments = [];

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->saveResource("messages.yml");
        $this->messages = new Config($this->getDataFolder() . "messages.yml");
        $this->saveDefaultConfig();
        $this->economyProvider = EconomyAPI::getInstance();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

        if (!PacketHooker::isRegistered()) PacketHooker::register($this);
        $this->getServer()->getCommandMap()->register("ceshop", new BookShopCommand($this, "cebuy", "Custom Enchantments Shop", ["ceshop", "cebuy"]));

        foreach (CustomEnchantManager::getEnchantments() as $enchants) {
            $excluded = $this->getConfig()->get("excluded-enchants", []);
            $enchantName = $enchants->getName() instanceof Translatable ? Server::getInstance()->getLanguage()->translate($enchants->getName()) : Server::getInstance()->getLanguage()->translateString($enchants->getName());
            if (!in_array($enchants->getId(), $excluded) && !in_array(strtolower($enchantName), $excluded)) {
                $this->enchantments[$enchants->getRarity()][] = $enchants;
            }
        }
    }

    public function getMessage(string $key, array $tags = []): string
    {
        return Utils::translateColorTags(str_replace(array_keys($tags), $tags, $this->messages->getNested($key, $key)));
    }

    public function getEconomyProvider(): EconomyAPI
    {
        return $this->economyProvider;
    }

    public function getEnchantmentsByRarity(int $rarity): array
    {
        if (isset($this->enchantments[$rarity])) {
            return $this->enchantments[$rarity];
        }
        return [];
    }

    /**
     * Adapted from https://stackoverflow.com/a/445363
     */
    public function getRandomWeightedElement(int $max): int
    {
        return intval(floor(1 + pow(lcg_value(), $this->getConfig()->getNested('chance.gamma', 1.5)) * $max));
    }

    public static function getInstance(): PCEBookShop
    {
        return self::$instance;
    }
}
