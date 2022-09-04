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
class FetchOHLCV {

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
    public function __construct(?\ccxt\Exchange $exchange = null) {
        if (is_null($exchange)) {
            $this->exchange = BotExchange::getInstance();
        }
        else {
            $this->exchange = $exchange;
        }
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
