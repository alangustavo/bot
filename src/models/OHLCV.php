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

    private $timestamp;
    private $open;
    private $high;
    private $low;
    private $close;
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

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getOpen() {
        return $this->open;
    }

    public function getHigh() {
        return $this->high;
    }

    public function getLow() {
        return $this->low;
    }

    public function getClose() {
        return $this->close;
    }

    public function getVolume() {
        return $this->volume;
    }

    public function GetDateFormatted($format = "Y-m-d H:i:s") {
        $date = new \DateTime();
        $date->setTimestamp($this->getTimestamp() / 1000);
        return $date->format($format);
    }

}
