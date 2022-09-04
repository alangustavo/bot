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
        }
        else {
            throw new BotException("'{$timeFrame}' is not a valid TimeFrame");
        }
    }

    public function __toString(): string {
        return $this->timeFrame;
    }

    public function getTimeFrame() {
        return $this->timeFrame;
    }

    public function getTimeUnit() {
        $tu = $this->timeFrame[-1];
        switch ($tu) {
            case "M":
                $timeUnit = "month";
                break;
            case "W":
                $timeUnit = "week";
                break;
            case "d":
                $timeUnit = "day";
                break;
            case "h":
                $timeUnit = "hour";
                break;
            case "m":
                $timeUnit = "minute";
                break;

            default:
                $timeUnit = false;
                break;
        }
        return $timeUnit;
    }

    public function getTimeQuantity() {
        return intval($this->timeFrame);
    }

}
