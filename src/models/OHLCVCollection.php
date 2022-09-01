<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\models;

/**
 * Description of OHLCVCollection
 *
 * @author alangustavo
 */
class OHLCVCollection {

    private $timestamps = [];
    private $opens      = [];
    private $highs      = [];
    private $lows       = [];
    private $closes     = [];
    private $volumes    = [];

    function add(OHLCV $ohlcv) {
        $this->timestamps[] = $ohlcv->getTimestamp();
        $this->opens[]      = $ohlcv->getOpen();
        $this->highs[]      = $ohlcv->getHigh();
        $this->lows[]       = $ohlcv->getLow();
        $this->closes[]     = $ohlcv->getClose();
        $this->volumes[]    = $ohlcv->getVolume();
    }

    public function getCount() {
        return count($this->timestamps);
    }

}
