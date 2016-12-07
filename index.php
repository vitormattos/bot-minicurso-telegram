<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;

if(file_exists('.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
}

$telegram = new Api();