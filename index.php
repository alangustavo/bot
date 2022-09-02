<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

require_once 'bootstrap.php';
date_default_timezone_set('UTC');
$e = new \App\extensions\BotExchange();

$tf   = new \App\models\TimeFrame("30m");
$data = $e->fetchOHLCV(timeframe: $tf, symbol: "SOL/USDT");
for ($i = 0; $i < $data->getCount(); $i++) {
    echo "\n" . $data->getFormatedTimeStamp($i);
}
