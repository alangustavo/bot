<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\models;

use DateTime;
use DateTimeZone;

/**
 * Description of OHLCVCollection
 *
 * @author alangustavo
 */
class OHLCVCollection {

    /**
     *
     * @var type
     */
    private $timestamps = [];
    private $opens      = [];
    private $highs      = [];
    private $lows       = [];
    private $closes     = [];
    private $volumes    = [];

    /**
     * Add a OHLCV to collection
     * @param OHLCV $ohlcv
     */
    public function add(OHLCV $ohlcv) {
        $this->timestamps[] = $ohlcv->getTimestamp();
        $this->opens[]      = $ohlcv->getOpen();
        $this->highs[]      = $ohlcv->getHigh();
        $this->lows[]       = $ohlcv->getLow();
        $this->closes[]     = $ohlcv->getClose();
        $this->volumes[]    = $ohlcv->getVolume();
    }

    /**
     * Return a quantity of elements in the collection
     * @return int
     */
    public function getCount() {
        return count($this->timestamps);
    }

    /**
     * Return an Array of Closes or one especific close from index.
     * @param int $index
     * @return (float[]|float)
     */
    public function getCloses(?int $index = null) {
        if ($index === null) {
            return $this->closes;
        }
        else {
            return $this->closes[$index];
        }
    }

    /**
     * Return an Array of open or one especific open from index.
     * @param int $index
     * @return (float[]|float)
     */
    public function getOpens(?int $index = null) {
        if ($index === null) {
            return $this->opens;
        }
        else {
            return $this->opens[$index];
        }
    }

    /**
     * Return an Array of timestamps or one especific timestamp from index.
     * @param int $index
     * @return (int[]|int)
     */
    public function getTimestamps(?int $index = null) {
        if ($index === null) {
            return $this->timestamps;
        }
        else {
            return $this->timestamps[$index];
        }
    }

    /**
     * Return an Array of highs or one especific high from index.
     * @param int $index
     * @return (float[]|float)
     */
    public function getHighs(?int $index = null) {
        if ($index === null) {
            return $this->highs;
        }
        else {
            return $this->highs[$index];
        }
    }

    /**
     * Return an Array of lows or one especific low from index.
     * @param int $index
     * @return (float[]|float)
     */
    public function getLows(?int $index = null) {
        if ($index === null) {
            return $this->lows;
        }
        else {
            return $this->lows[$index];
        }
    }

    /**
     * Return an Array of volumes or one especific volume from index.
     * @param int $index
     * @return (float[]|float)
     */
    public function getVolumes(?int $index = null) {
        if ($index === null) {
            return $this->volumes;
        }
        else {
            return $this->volumes[$index];
        }
    }

    /**
     *
     * @param int $index
     * @param string $format
     * @return string
     */
    public function getFormatedTimeStamp($index, $format = "Y-m-d H:i:s"): string {

        $date = new DateTime('@' . $this->getTimestamps($index) / 1000, new DateTimeZone('UTC'));
        return $date->format($format);
    }

}
