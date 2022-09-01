<?php

namespace App\services;

use App\extensions\BotExchange as Exchange2;
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
     * Exchange
     * @var Exchange
     */
    private $exchange;

    /**
     *
     * @param string $symbol - ex.: BTC/USDT
     * @param Exchange2 $exchange
     */
    public function __construct(string $symbol, TimeFrame $timeFrame, Exchange2 $exchange) {

        $this->exchange = $exchange->getExchange();
        $precision      = ini_get('trader.real_precision');
    }

}
