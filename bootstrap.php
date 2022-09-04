<?php

use App\extensions\BotException;
use Dotenv\Dotenv;

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */
date_default_timezone_set('UTC');
$DS = DIRECTORY_SEPARATOR;

require_once __DIR__ . "{$DS}vendor{$DS}autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "\n******* STARTING  BOT *******";
echo "\nDEFAULT ENVIROMENT...: " . $_ENV["ENVIROMENT"] . "\n";
$extensions = get_loaded_extensions();
if (!in_array("trader", $extensions)) {
    $message = "Enviroment Error:\r\n";
    $message .= "Trader extension must be enabled in php.ini.\r\n";
    $message .= "Please, check https://www.php.net/manual/pt_BR/book.trader.php to find out how to \r\n";
    $message .= "enable the 'trader' extension.";
    throw new BotException($message, 1);
}


$precision = ini_get('trader.real_precision');

if ($precision != 8) {
    $message = "Enviroment Error:\r\n";
    $message .= "The precision of the trader extension needs to be equal to 8 (I found $precision) to work with cryptocurrencies.\r\n";
    $message .= "Please include the following in php.ini:\r\n";
    $message .= "trader.real_precision=8";
    throw new BotException($message);
}