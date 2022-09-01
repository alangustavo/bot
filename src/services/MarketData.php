<?php

namespace App\services;

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
     *
     * @var ccxt/
     */
    private $exchange;

    public function __construct(string $symbol, ?string $exchange = null) {
        
    }

}
