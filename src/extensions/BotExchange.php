<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\extensions;

use ccxt\Exchange;

/**
 * Description of BotExchange
 *
 * @author alangustavo
 */
class BotExchange {

    /**
     * ccxt/exchange
     * @var Exchange[];
     */
    private static $exchange = [];

    /**
     * ccxt/exchange
     * @var Exchange[];
     */
    private static $testExchange = [];

    /**
     * To enable singleton
     */
    private function __construct() {
        // Singleton;
    }

    /**
     * Constructor of Class
     * @param string|null $exchangeName - if you not send an exchange the construct will use the $_ENV["EXCHANGE"]
     * @throws BotException
     */
    public static function getInstance(?string $exchangeName = null) {
        if ($exchangeName === null) {
            $exchangeName = $_ENV["EXCHANGE"];
        }

        if (self::isValidExchange($exchangeName)) {
            $exchange_class                = "\\ccxt\\$exchangeName";
            self::$exchange[$exchangeName] = new $exchange_class(array(
                'apiKey'          => $_ENV[strtoupper("{$exchangeName}_API_KEY")],
                'secret'          => $_ENV[strtoupper("{$exchangeName}_API_SECRET")],
                'enableRateLimit' => true
            ));
            self::$exchange[$exchangeName]->load_markets();
        }
        else {
            $message = "I didn't find this exchange '{$exchangeName}' in the list of supported exchanges (ccxt).";
            $message .= "Please, check: https://docs.ccxt.com/en/latest/exchange-markets.html?highlight=exchanges";
            $message .= "to know the list of supported exchanges";
            throw new BotException($message);
        }
        return self::$exchange[$exchangeName];
    }

    /**
     * Check if the exchangeName is supported by ccxt
     * @return bool
     */
    private static function isValidExchange(string $exchangeName): bool {
        return in_array($exchangeName, Exchange::$exchanges);
    }

    public static function getSandBoxInstance(?string $exchangeName = null) {
        if ($exchangeName === null) {
            $exchangeName = $_ENV["EXCHANGE"];
        }

        if (self::isValidExchange($exchangeName)) {
            $exchange_class                    = "\\ccxt\\$exchangeName";
            self::$testExchange[$exchangeName] = new $exchange_class(array(
                'apiKey'          => $_ENV[strtoupper("{$exchangeName}_TEST_API_KEY")],
                'secret'          => $_ENV[strtoupper("{$exchangeName}_TEST_API_SECRET")],
                'enableRateLimit' => true
            ));
            self::$testExchange[$exchangeName]->set_sandbox_mode(true);
            self::$testExchange[$exchangeName]->load_markets();
        }
        else {
            $message = "I didn't find this exchange '{$exchangeName}' in the list of supported exchanges (ccxt).";
            $message .= "Please, check: https://docs.ccxt.com/en/latest/exchange-markets.html?highlight=exchanges";
            $message .= "to know the list of supported exchanges";
            throw new BotException($message);
        }
        return self::$testExchange[$exchangeName];
    }

}
