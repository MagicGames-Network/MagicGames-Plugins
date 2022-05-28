<?php

namespace Pushkar\MagicCore\utils;

final class Configuration
{
    public const VIP_COST = 5000000;
    public const VIP_PLUS_COST = 8000000;
    public const MVP_COST = 10000000;
    public const MVP_PLUS_COST = 13000000;
    public const MVP_PLUS_PLUS_COST = 16000000;
    
    public static array $worldsToLoad = [
        "Mining"
    ];

    public static bool $rejoinOnStop = true;
    public static string $rejoinIP = "play.magicgamesmc.net";
    public static string $rejoinPort = "";

    public static string $logWebhookUrl = "https://discord.com/api/webhooks/976331900899717130/ai9F82EUk7fJH0Yklfo1aKKeCsHaVlOtEaDoJHaC_Mu3pOAKmqzDl4NmGOkxBNPK_FpR";

    public static bool $joinTeleport = true;
    public static bool $joinDisableFlight = true;

    public static bool $firstJoinItems = true;
    public static array $joinItemList = [
        [
            "slot" => 1,
            "id" => 272,
            "meta" => 0,
            "count" => 1,
            "name" => "Starter Sword",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 2,
            "id" => 275,
            "meta" => 0,
            "count" => 1,
            "name" => "Starter Axe",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 3,
            "id" => 274,
            "meta" => 0,
            "count" => 1,
            "name" => "Starter Pickaxe",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 4,
            "id" => 273,
            "meta" => 0,
            "count" => 1,
            "name" => "Starter Shovel",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 5,
            "id" => 320,
            "meta" => 0,
            "count" => 32,
            "name" => "Porkchop",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 6,
            "id" => 8,
            "meta" => 0,
            "count" => 2,
            "name" => "Water Bucket",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 7,
            "id" => 10,
            "meta" => 0,
            "count" => 2,
            "name" => "Lava Bucket",
            "lore" => "Welcome to MagicGames!"
        ],
        [
            "slot" => 9,
            "id" => 264,
            "meta" => 0,
            "count" => 8,
            "name" => "Diamond",
            "lore" => "Welcome to MagicGames!"
        ]
    ];

    public static bool $firstJoinCommands = true;
    public static array $joinCommandsList = [
        "minion give {player} mining 4"
    ];

    public static bool $firstJoinArmor = true;
    public static array $joinArmorList = [
        [
            "type" => "helmet",
            "id" => 298,
            "name" => "",
            "lore" => ""
        ],
        [
            "type" => "chestplate",
            "id" => 299,
            "name" => "",
            "lore" => ""
        ],
        [
            "type" => "leggings",
            "id" => 300,
            "name" => "",
            "lore" => ""
        ],
        [
            "type" => "boots",
            "id" => 301,
            "name" => "",
            "lore" => ""
        ]
    ];

    public static bool $anvilUI = true;
    public static bool $grindStoneUI = true;

    public static string $voteVoucherCommand = "temprank set \"{player}\" Voter 12h";
    public static string $youtubeRankCommand = "temprank set \"{player}\" YouTube 90d";
    public static string $boostOneRankCommand = "temprank set \"{player}\" VIPPLUS 15d";
    public static string $boostTwoRankCommand = "temprank set \"{player}\" MVP 15d";
    public static string $adminRankCommand = "temprank set \"{player}\" Admin 30d";
    public static string $modRankCommand = "temprank set \"{player}\" Mod 30d";
    public static string $helperRankCommand = "temprank set \"{player}\" Helper 30d";
    public static string $removeRankCommand = "temprank remove \"{player}\"";

    public static bool $damageFlyReset = true;

    public static bool $voidLoseMoney = true;
    public static bool $killMoneyLose = true;
    public static bool $killerGainMoney = true;
    public static bool $naturalMoneyLost = false;
    
    public static string $loseMoneyType = "percent";
    public static float $moneyLoseAmount = 25.00;

    public static bool $keepInventory = true;
    public static array $noKeepInventoryList = [
        "Arena"
    ];
}
