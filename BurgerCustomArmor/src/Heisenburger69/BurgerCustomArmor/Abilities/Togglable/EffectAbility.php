<?php

namespace Heisenburger69\BurgerCustomArmor\Abilities\Togglable;

use pocketmine\player\Player;
use pocketmine\entity\effect\EffectInstance;

class EffectAbility extends TogglableAbility
{
    /**
     * @var EffectInstance
     */
    private $effect;

    public function __construct(EffectInstance $effectInstance)
    {
        $this->effect = $effectInstance;
    }

    public function on(Player $player)
    {
        $player->getEffects()->add($this->effect);
    }

    public function off(Player $player)
    {
        if ($player->getEffects()->has($this->effect->getType())) {
            $player->getEffects()->remove($this->effect->getType());
        }
    }
}