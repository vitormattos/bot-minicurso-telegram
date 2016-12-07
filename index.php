<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

if(file_exists('.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    class mockApi extends Api{
        public function getWebhookUpdates($emitUpdateWasReceivedEvent = true) {
            return new Update(json_decode(getenv('MOCK_JSON'), true));
        }
    }
    $telegram = new mockApi();
} else {
    error_log(file_get_contents('php://input'));
    $telegram = new Api();
}

$update = $telegram->getWebhookUpdates();
if($update->has('message')) {
    $message = $update->getMessage();
    if($message->has('text')) {
        switch($text = $message->getText()) {
            case '/about':
                $telegram->sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => 'Sobre alguma coisa'
                ]);
                break;
            case '/start':
            case (preg_match('/^\/start (?<token>[a-f0-9]{32})/', $text, $matches) ? true : false):
                break;
        }
    }
}