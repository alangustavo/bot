<?php

namespace Test\App\extensions;

use App\extensions\BotException;
use App\extensions\BotExchange;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2022-09-01 at 18:49:42.
 */
class BotExchangeTest extends TestCase {

    public function testBinanceAsValidExchange() {

        $exchange = BotExchange::getInstance("binance");
        $this->assertEquals("ccxt\\binance", get_class($exchange));
    }

    public function testKrakenAsValidExchange() {

        $_ENV["KRAKEN_API_KEY"]    = "123";
        $_ENV["KRAKEN_API_SECRET"] = 123;
        $exchange                  = BotExchange::getInstance("kraken");
        $this->assertEquals("ccxt\\kraken", get_class($exchange));
    }

    public function testInvalidExchante() {
        $this->expectException(BotException::class);
        BotExchange::getInstance("inexistent");
    }

    public function testDefaultExchange() {
        $_ENV["EXCHANGE"] = "binance";
        $exchange         = BotExchange::getInstance();
        $this->assertEquals("ccxt\\binance", get_class($exchange));
    }

}
