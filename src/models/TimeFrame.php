<?php

namespace App\models;

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */
use App\extensions\BotException;
/**
 * Description of TimeFrame
 *
 * @author alangustavo
 */
class TimeFrame {

    private $timeFrame;

    public function __construct($timeFrame) {
        $validTimeFrames = ["1m", "3m", "5m", "15m", "30m", "1h", "2h", "4h", "6h", "8h", "12h", "1d", "3d", "1W", "1M"];
        if (in_array($timeFrame, $validTimeFrames)) {
            $this->timeFrame = $timeFrame;
        } else {
            throw new BotException("'{$timeFrame}' is not a valid TimeFrame");
        }
    }
    
    public function __toString() : string{
        return $this->timeFrame;
    }

}
