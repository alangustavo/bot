<?php

namespace Test\App\services;

use App\extensions\FetchOHLCV;
use App\models\TimeFrame;
use App\services\MarketData;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2022-09-03 at 13:26:09.
 */

/**
 * @runTestsInSeparateProcesses
 */
class MarketDataTest extends TestCase {

    /**
     * @var MarketData
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new MarketData(symbol: "SOL/USDT", timeframe: new TimeFrame("30m"), fetchOHLCV: new FetchOHLCV());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {

    }

    /**
     * @covers App\services\MarketData::getMarketData
     * @todo   Implement testGetMarketData().
     * @skip
     */
    public function testGetMarketData() {
        $this->markTestSkipped("This Tests use BinanceAPI");
        $md = $this->object->getMarketData();
        $this->assertEquals("App\models\OHLCVCollection", get_class($md));
        $this->assertEquals(500, $md->getCount());
    }

    public function testGetHistoricalMarketData() {
        $this->markTestSkipped("This Tests use BinanceAPI");
        $md         = $this->object->getHistoricalMarketData(since: new DateTime("2021-12-31 00:00:00"), limit: 10);
        $this->assertEquals("App\models\OHLCVCollection", get_class($md));
        $this->assertEquals(10, $md->getCount());
        $this->assertEquals("2021-12-31 00:00:00", $md->getFormatedTimeStamp(9));
        $this->assertEquals("2021-12-30 19:30:00", $md->getFormatedTimeStamp(0));
        $timestamps = $md->getTimestamps();
        $ini        = $timestamps[0];
        $end        = end($timestamps);
        $this->assertEquals(1640892600000, $ini);
        $this->assertEquals(1640908800000, $end);
    }

    public function testGetHistoricalMarketData2() {
        $this->markTestSkipped("This Tests use BinanceAPI");

        $md         = $this->object->getHistoricalMarketData(since: new DateTime("2022-03-01 14:00:00"), limit: 20);
        $this->assertEquals("App\models\OHLCVCollection", get_class($md));
        $this->assertEquals(500, $md->getCount());
        $this->assertEquals("2022-03-01 14:00:00", $md->getFormatedTimeStamp(499));
        $this->assertEquals("2022-02-19 04:30:00", $md->getFormatedTimeStamp(0));
        $timestamps = $md->getTimestamps();
        $ini        = $timestamps[0];
        $end        = end($timestamps);
        $this->assertEquals(1645245000000, $ini);
        $this->assertEquals(1646143200000, $end);
    }

}
