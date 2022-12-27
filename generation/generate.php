<?php

use IparapheurV5Client\Generate\GenerateObjectModel;
use IparapheurV5Client\Generate\GenerateQueryModel;

require_once __DIR__ . "/../vendor/autoload.php";

$json = json_decode(
    file_get_contents(__DIR__ . "/../openapi/iparapheur-5.0.4.json"),
    true,
    512,
    JSON_THROW_ON_ERROR
);

$model_dir = __DIR__ . "/../src/Model";
$api_dir = __DIR__ . "/../src/Api";


if (!is_dir($model_dir)) {
    if (!mkdir($model_dir, 0775, true) && !is_dir($model_dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $model_dir));
    }
}

$generate = new GenerateObjectModel();
$all_file = $generate->generate($json);

foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($model_dir . "/" . $dtoId . ".php", $dtoContent);
}

$generate = new GenerateQueryModel();
$all_file = $generate->generate($json);

foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($api_dir . "/" . $dtoId . ".php", $dtoContent);
}

$all_file = $generate->generateQueryModel($json);
foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($model_dir . "/" . $dtoId . ".php", $dtoContent);
}
