<?php

require __DIR__.'/vendor/autoload.php';

$a = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost:8081',
    'defaults' => [
        'exceptions' => false,
    ]

]);

$response = $a->post('/Api');

echo $response;