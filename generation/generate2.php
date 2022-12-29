<?php

use cebe\openapi\Reader;
use IparapheurV5Client\Generate\OpenApiSerializer;

require_once __DIR__ . "/../vendor/autoload.php";
$openapi = Reader::readFromJsonFile(dirname(__DIR__) . "/openapi/iparapheur-5.0.4.json");

$generateClass = new \IparapheurV5Client\Generate\GenerateClass();

$all_file = $generateClass->generate($openapi);

print_r($all_file);