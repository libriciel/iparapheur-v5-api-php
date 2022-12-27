<?php

require_once __DIR__ . '/../vendor/autoload.php';

use IparapheurV5Client\Client;
use IparapheurV5Client\TokenQuery;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\Psr18Client;

$httpClient = new Psr18Client();

$client = Client::createWithHttpClient($httpClient);

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

$tokenQuery = new TokenQuery();
$tokenQuery->username = $_ENV['USERNAME'];
$tokenQuery->password = $_ENV['PASSWORD'];

$client->authenticate($_ENV['URL'], $tokenQuery);

print_r($client->trashbinFolder()->getList($_ENV['TENANT_ID']));
