<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\models;

/**
 * OHLCV - Open Hight Low Close Volume
 *
 * @author alangustavo
 */
class OHLCV {

    /**
     * A timestamp date
     * @var int
     */
    private $timestamp;

    /**
     * Open: first traded price in that period
     * @var float
     */
    private $open;

    /**
     * Upper wick: highest traded price in that period
     * @var float
     */
    private $high;

    /**
     * Lower wick: lowest traded price in that period.
     * @var float
     */
    private $low;

    /**
     * Close: last traded price in that period
     * @var float
     */
    private $close;

    /**
     * Volume float (usually in terms of the base currency, the exchanges docstring may list whether quote or base units are used)
     * @var float
     */
    private $volume;

    /**
     * [
     *   1504541580000, // UTC timestamp in milliseconds, integer
     *   4235.4,        // (O)pen price, float
     *   4240.6,        // (H)ighest price, float
     *   4230.0,        // (L)owest price, float
     *   4230.7,        // (C)losing price, float
     *   37.72941911    // (V)olume float (usually in terms of the base currency, the exchanges docstring may list whether quote or base units are used)
     * ]
     */
    public function __construct(array $ohlcv) {
        $this->timestamp = $ohlcv[0];
        $this->open      = $ohlcv[1];
        $this->high      = $ohlcv[2];
        $this->low       = $ohlcv[3];
        $this->close     = $ohlcv[4];
        $this->volume    = $ohlcv[5];
    }

    /**
     * Get UTC timestamp in milliseconds
     * @return int
     */
    public function getTimestamp(): int {
        return $this->timestamp;
    }

    /**
     * Get first traded price in that period
     * @return float
     */
    public function getOpen(): float {
        return $this->open;
    }

    /**
     * Get highest traded price in that period
     * @return float
     */
    public function getHigh(): float {
        return $this->high;
    }

    /**
     * Get lowest traded price in that period.
     * @return float
     */
    public function getLow(): float {
        return $this->low;
    }

    /**
     * Get last traded price in that period
     * @return float
     */
    public function getClose(): float {
        return $this->close;
    }

    /**
     * Volume float (usually in terms of the base currency, the exchanges docstring may list whether quote or base units are used)
     * @return float
     */
    public function getVolume(): float {
        return $this->volume;
    }

    /**
     * Get a formated Date
     * @param string $format
     * @return string
     */
    public function getDateFormat($format = "Y-m-d H:i:s"): string {
        $date = new \DateTime();
        $date->setTimestamp($this->getTimestamp() / 1000);
        return $date->format($format);
    }

}
