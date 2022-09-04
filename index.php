<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

require_once 'bootstrap.php';
date_default_timezone_set('UTC');
//$e = new \App\extensions\FetchOHLCV();
//
//$tf   = new \App\models\TimeFrame("30m");
//$data = $e->fetchOHLCV(timeframe: $tf, symbol: "SOL/USDT");
//for ($i = 0; $i < $data->getCount(); $i++) {
//    echo "\n" . $data->getFormatedTimeStamp($i);
//}

$e       = new App\extensions\BotExchange();
$e->sandbox_mode();
$balance = $e->getExchange();
$b       = $balance->fetchBalance();
//var_dump($b);
var_dump($b["free"]["USDT"]);
