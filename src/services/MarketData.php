<?php

namespace App\services;

use App\extensions\BotExchange;
use App\models\OHLCVCollection;
use App\models\TimeFrame;
use ccxt\Exchange;

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

/**
 * Description of MarketData
 *
 * @author alangustavo
 */
class MarketData {

    /**
     * Symbol like SOL/USDT
     * @var string
     */
    private $symbol;

    /**
     * timeframe
     * @var TimeFrame
     */
    private $timeframe;

    /**
     * Exchange
     * @var Exchange
     */
    private $exchange;

    /**
     *
     * @var OHLCVCollection
     */
    private $data;

    /**
     *
     * @param string $symbol - ex.: BTC/USDT
     * @param BotExchange $exchange
     */
    public function __construct(string $symbol, TimeFrame $timeFrame, BotExchange $exchange) {
        $this->exchange  = $exchange;
        $this->symbol    = $symbol;
        $this->timeframe = $timeFrame;
        $this->data      = new OHLCVCollection();
    }

    public function getMarketData() {

    }

}
