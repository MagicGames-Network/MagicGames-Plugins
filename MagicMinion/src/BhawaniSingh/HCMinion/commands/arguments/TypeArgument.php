<?php

declare(strict_types=1);

namespace BhawaniSingh\HCMinion\commands\arguments;

use CortexPE\Commando\args\StringEnumArgument;
use BhawaniSingh\HCMinion\minions\MinionType;
use pocketmine\command\CommandSender;

class TypeArgument extends StringEnumArgument
{
    public const VALUES = [
        '0' => MinionType::MINING_MINION,
        '1' => MinionType::FARMING_MINION,
        '2' => MinionType::LUMBERJACK_MINION,
        'mining' => MinionType::MINING_MINION,
        'farming' => MinionType::FARMING_MINION,
        'lumberjack' => MinionType::LUMBERJACK_MINION,
    ];

    public function parse(string $argument, CommandSender $sender): int
    {
        return $this->getValue($argument);
    }

    public function getValue(string $string)
    {
        return parent::getValue($string) ?? -1;
    }

    public function getTypeName(): string
    {
        return 'type';
    }
}
