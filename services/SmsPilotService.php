<?php

namespace app\services;

class SmsPilotService
{
    const API_URL = 'https://smspilot.ru/api.php';
    const RESPONSE_FORMAT = 'json';
    const SENDER = 'MyBookLibrary';
    const API_KEY = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';

    public static function send($phone, $message)
    {
        $url = self::API_URL
            .'?send='.urlencode( $message )
            .'&to='.urlencode( $phone )
            .'&from='.self::SENDER
            .'&apikey='.self::API_KEY
            .'&format='.self::RESPONSE_FORMAT;

        $json = file_get_contents($url);

        return json_decode($json);
    }
}