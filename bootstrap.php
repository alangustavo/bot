<?php

/*
 * Este arquivo é parte do Projeto bot
 * Autor:alangustavo
 */

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "\n******* STARTING  BOT *******";
echo "\nDEFAULT ENVIROMENT...: " . $_ENV["ENVIROMENT"] . "\n";
