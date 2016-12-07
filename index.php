<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$telegram = new Api();

