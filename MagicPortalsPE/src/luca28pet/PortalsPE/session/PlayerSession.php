<?php
declare(strict_types=1);

namespace luca28pet\PortalsPE\session;

use luca28pet\PortalsPE\selection\PartialPortalSelection;
use pocketmine\player\Player;

class PlayerSession{

    /** @var Player|null */
    private ?Player $player;
    /** @var PartialPortalSelection|null */
    private ?PartialPortalSelection $selection;
    /** @var bool */
    private bool $selectingFirstBlock;
    /** @var bool */
    private bool $selectingSecondBlock;

    public function __construct(Player $player, PartialPortalSelection $selection, bool $selectingFirstBlock, bool $selectingSecondBlock){
        $this->player = $player;
        $this->selection = $selection;
        $this->selectingFirstBlock = $selectingFirstBlock;
        $this->selectingSecondBlock = $selectingSecondBlock;
    }

    public function getPlayer() : Player{
        return $this->player;
    }

    public function getSelection() : PartialPortalSelection{
        return $this->selection;
    }

    public function setSelection(PartialPortalSelection $selection) : void{
        $this->selection = $selection;
    }

    public function isSelectingFirstBlock() : bool{
        return $this->selectingFirstBlock;
    }

    public function setSelectingFirstBlock(bool $selectingFirstBlock) : void{
        $this->selectingFirstBlock = $selectingFirstBlock;
    }

    public function isSelectingSecondBlock() : bool{
        return $this->selectingSecondBlock;
    }

    public function setSelectingSecondBlock(bool $selectingSecondBlock) : void{
        $this->selectingSecondBlock = $selectingSecondBlock;
    }

    public function close() : void{
        $this->player = null;
        $this->selection = null;
    }

}