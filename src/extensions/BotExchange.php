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
use ccxt\Exchange;

/**
 * Create a ccxt/exchange with default values.
 *
 * @author alangustavo
 */
class BotExchange {

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
    public function __construct(?string $exchange = null) {
        if ($exchange === null) {
            $exchange = $_ENV["EXCHANGE"];
        }
        if ($this->isValidExchange($exchange)) {
            $exchange_class = "\\ccxt\\$exchange";
            $this->exchange = new $exchange_class(array(
                'apiKey' => $_ENV["API_KEY"],
                'secret' => $_ENV["API_SECRET"],
            ));
        }
        else {
            $message = "I didn't find this exchange '{$exchange}' in the list of supported exchanges (ccxt).";
            $message .= "Please, check: https://docs.ccxt.com/en/latest/exchange-markets.html?highlight=exchanges";
            $message .= "to know the list of supported exchanges";
            throw new BotException($message);
        }
    }

    /**
     * Check if the $exchange is supported by ccxt
     * @param string $exchange
     * @return bool
     */
    private function isValidExchange(string $exchange): bool {
        return in_array($exchange, Exchange::$exchanges);
    }

    /**
     * Return an Exchange from ccxt
     * @return Exchange
     */
    public function getExchange(): Exchange {
        return $this->exchange;
    }

    /**
     * Return a OHLCVCollection with the data.
     * @param string $symbol
     * @param TimeFrame $timeframe
     * @return OHLCVCollection
     */
    public function fetchOHLCV(string $symbol, TimeFrame $timeframe, ?\DateTime $since = null, int $limit = 499) {

        $collection = new OHLCVCollection();
        $limit++;
        if ($since != null) {
            $timeQuantity = $timeframe->getTimeQuantity();
            $str          = "{$timeQuantity} {$timeframe->getTimeUnit()}";
            $since->sub(\DateInterval::createFromDateString($str));
            $data         = $this->exchange->fetch_ohlcv(symbol: $symbol, timeframe: $timeframe->getTimeFrame(), since: $since->getTimestamp() * 1000, limit: $limit);
        }
        else {

            $data = $this->exchange->fetch_ohlcv(symbol: $symbol, timeframe: $timeframe->getTimeFrame(), limit: $limit);
        }

        foreach ($data as $ohlcv) {
            $collection->add(new OHLCV($ohlcv));
        }
        return $collection;
    }

}
