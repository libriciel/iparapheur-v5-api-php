<?php

use IparapheurV5Client\Generate\GenerateQueryModel;
use IparapheurV5Client\Generate\GenerateClass;

require_once __DIR__ . "/../vendor/autoload.php";

$generateClass = new GenerateClass();
$all_file = $generateClass->generate();
foreach ($all_file as $filename => $filecontent) {
    file_put_contents($filename, $filecontent);
}

$json = json_decode(
    file_get_contents(__DIR__ . "/../openapi/iparapheur-5.0.4.json"),
    true,
    512,
    JSON_THROW_ON_ERROR
);

$model_dir = __DIR__ . "/../src/Model";
$api_dir = __DIR__ . "/../src/Api";

$generate = new GenerateQueryModel();
$all_file = $generate->generate($json);

foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($api_dir . "/" . $dtoId . ".php", $dtoContent);
}

$all_file = $generate->generateQueryModel($json);
foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($model_dir . "/" . $dtoId . ".php", $dtoContent);
}
