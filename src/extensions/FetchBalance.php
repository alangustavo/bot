<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\extensions;

date_default_timezone_set('UTC');

use App\models\OHLCV;
use App\models\OHLCVCollection;
use App\models\TimeFrame;

/**
 * Create a ccxt/exchange with default values.
 *
 * @author alangustavo
 */
class FetchBalance {

    /**
     * ccxt/exchange
     * @var Exchange;
     */
    private $exchange;

    /**
     * Constructor of Class
     * @param string|null $exchange - if you not send an exchange the construct will use the $_ENV["EXCHANGE"]
     * @throws BotException
     */
    public function __construct(?BotExchange $botExchange = null) {
        if (is_null($botExchange)) {
            $botExchange    = new BotExchange();
            $this->exchange = $botExchange->getExchange();
        }
    }

    /**
     * Return a OHLCVCollection with the data.
     * @param string $symbol
     * @param TimeFrame $timeframe
     * @return OHLCVCollection
     */
    public function fetchBalance(string $coin) {
        $this->exchange->fetch_balance();
    }

}
