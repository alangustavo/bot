<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

namespace App\database;

use App\models\OHLCV;
use App\models\OHLCVCollection;
use App\models\TimeFrame;
use SQLite3;

/**
 * Description of Database
 *
 * @author alangustavo
 */
class OHLCVFromDatabase {

    private $db;

    public function __construct(string $symbol, TimeFrame $timeframe) {
        // Fornece: <body text='black'>
        $symbolName   = str_replace("/", "", $symbol);
        $databaseName = "{$symbolName}_{$timeframe}.db3";
        if (!file_exists("../db/{$databaseName}")) {
            $this->createDatabase($databaseName);
        }
        else {
            $this->db = new SQLite3("../db/{$databaseName}");
        }
    }

    private function createDatabase(string $databaseName) {
        $this->db = new SQLite3("../db/{$databaseName}");

        $command = <<<EOF
            CREATE TABLE "ohlcv" (
                "timestamp"	INTEGER NOT NULL,
                "open"	NUMERIC NOT NULL,
                "high"	NUMERIC NOT NULL,
                "low"	NUMERIC NOT NULL,
                "close"	NUMERIC NOT NULL,
                "volume"	NUMERIC NOT NULL,
                PRIMARY KEY("timestamp"));
EOF;
        $this->db->exec($command);
    }

    public function saveOHLCV(OHLCVCollection $data) {
        $c = $data->getCount();

        $sql = "INSERT OR IGNORE INTO ohlcv (timestamp, open, high, low, close, volume) VALUES "
                . "(:timestamp, :open, :high, :low, :close, :volume) ";

        for ($i = 0; $i < $c; $i++) {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':timestamp', $data->getTimestamps($i), SQLITE3_INTEGER);
            $stmt->bindValue(':open', $data->getOpens($i), SQLITE3_NUM);
            $stmt->bindValue(':high', $data->getHighs($i), SQLITE3_NUM);
            $stmt->bindValue(':low', $data->getLows($i), SQLITE3_NUM);
            $stmt->bindValue(':close', $data->getCloses($i), SQLITE3_NUM);
            $stmt->bindValue(':volume', $data->getVolumes($i), SQLITE3_NUM);
            try {
                $stmt->execute();
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }

    public function queryDatabase(string $query): OHLCVCollection {
        $data    = new OHLCVCollection();
        $results = $this->db->query($query);
        while ($row     = $results->fetchArray(SQLITE3_NUM)) {
            $data->add(new OHLCV($row));
        }
        return $data;
    }

}
