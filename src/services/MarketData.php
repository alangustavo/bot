<?php

namespace App\services;

use App\database\OHLCVFromDatabase;
use App\extensions\FetchOHLCV;
use App\models\OHLCVCollection;
use App\models\TimeFrame;
use ccxt\Exchange;
use DateInterval;
use DateTime;

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

/**
 * This class is responsible for getting market data.
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
     * @var FetchOHLCV
     */
    private $fetchOHLCV;

    /**
     *
     * @var OHLCVCollection
     */
    private $data;

    /**
     *
     * @param string $symbol - ex.: BTC/USDT
     * @param FetchOHLCV $fetchOHLCV
     */
    public function __construct(string $symbol, TimeFrame $timeframe, FetchOHLCV $fetchOHLCV) {
        $this->fetchOHLCV = $fetchOHLCV;
        $this->symbol     = $symbol;
        $this->timeframe  = $timeframe;
        $this->data       = new OHLCVCollection();
    }

    public function getMarketData() {

        $this->data = $this->fetchOHLCV->fetchOHLCV(timeframe: $this->timeframe, symbol: $this->symbol);
        return $this->data;
    }

    public function getHistoricalMarketData(DateTime $since, int $limit = 500) {

        $timeQuantity = $this->timeframe->getTimeQuantity() * ($limit - 1);
        $str          = "{$timeQuantity} {$this->timeframe->getTimeUnit()}";
        $endDate      = $since->getTimestamp() * 1000;
        $since->sub(DateInterval::createFromDateString($str));
        $iniDate      = $since->getTimestamp() * 1000;

        $this->data = $this->getHistoricalMarketDataFromDatabase($iniDate, $endDate, $limit);
        if ($this->data->getCount() == $limit) {
            return $this->data;
        }
        else {
            $this->data = $this->fetchOHLCV->fetchOHLCV(timeframe: $this->timeframe, symbol: $this->symbol, since: $since, limit: $limit);
            $this->saveOHLCV($this->data);
            return $this->data;
        }
    }

    private function getHistoricalMarketDataFromDatabase(int $ini, int $end): OHLCVCollection {
        $db   = new OHLCVFromDatabase(symbol: $this->symbol, timeframe: $this->timeframe);
        $data = $db->queryDatabase("SELECT * FROM ohlcv WHERE timestamp BETWEEN {$ini} AND {$end} ORDER BY timestamp");
        return $data;
    }

    private function getHistoricalMarketDataFromExchange(DateTime $since, int $limit = 500) {
        $timeQuantity = $this->timeframe->getTimeQuantity() * ($limit - 1);
        $str          = "{$timeQuantity} {$this->timeframe->getTimeUnit()}";
        $since->sub(DateInterval::createFromDateString($str));
        return $this->data;
    }

    private function saveOHLCV(OHLCVCollection $data) {
        $db = new OHLCVFromDatabase(symbol: $this->symbol, timeframe: $this->timeframe);
        $db->saveOHLCV($data);
    }

}
