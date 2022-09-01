<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\extensions;

/**
 * Create a ccxt/exchange with default values.
 *
 * @author alangustavo
 */
class Exchange {

    /**
     * ccxt/exchange
     * @var ccxt/exchange;
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
            throw new BotException("I didn't find this exchange '{$exchange}' in my list of supported exchanges.");
        }
    }

    /**
     * Check if the $exchange is supported by ccxt
     * @param string $exchange
     * @return bool
     */
    private function isValidExchange(string $exchange): bool {
        return in_array($exchange, \ccxt\Exchange::$exchanges);
    }

    /**
     * Return an Exchange from ccxt
     * @return \ccxt\Exchange
     */
    public function getExchange(): \ccxt\Exchange {
        return $this->exchange;
    }

}
