<?php

namespace Test\App\models;

use App\models\OHLCV;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2022-09-01 at 03:12:29.
 */
class OHLCVTest extends \PHPUnit\Framework\TestCase {

    /**
     * @var OHLCV
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $ohcl         = [
            1504541580000, // UTC timestamp in milliseconds, integer
            4235.4, // (O)pen price, float
            4240.6, // (H)ighest price, float
            4230.0, // (L)owest price, float
            4230.7, // (C)losing price, float
            37.72941911    // (V)olume float (usually in terms of the base currency, the exchanges docstring may list whether quote or base units are used)
        ];
        $this->object = new OHLCV($ohcl);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {

    }

    /**
     * @covers App\models\OHLCV::getTimestamp
     * @todo   Implement testGetTimestamp().
     */
    public function testGetTimestamp() {
        $this->assertEquals(1504541580000, $this->object->GetTimestamp());
    }

    /**
     * @covers App\models\OHLCV::getOpen
     * @todo   Implement testGetOpen().
     */
    public function testGetOpen() {
        $this->assertEquals(4235.4, $this->object->GetOpen());
    }

    /**
     * @covers App\models\OHLCV::getHigh
     * @todo   Implement testGetHigh().
     */
    public function testGetHigh() {
        $this->assertEquals(4240.6, $this->object->GetHigh());
    }

    /**
     * @covers App\models\OHLCV::getLow
     * @todo   Implement testGetLow().
     */
    public function testGetLow() {
        $this->assertEquals(4230.0, $this->object->GetLow());
    }

    /**
     * @covers App\models\OHLCV::getClose
     * @todo   Implement testGetClose().
     */
    public function testGetClose() {
        $this->assertEquals(4230.7, $this->object->GetClose());
    }

    /**
     * @covers App\models\OHLCV::getVolume
     * @todo   Implement testGetVolume().
     */
    public function testGetVolume() {
        $this->assertEquals(37.72941911, $this->object->GetVolume());
    }

    /**
     * @covers App\models\OHLCV::GetDateFormatted
     * @todo   Implement testGetDateFormatted().
     */
    public function testGetDateFormatted() {
        $this->assertEquals("2017-09-04 16:13:00", $this->object->getDateFormat());
    }

}
