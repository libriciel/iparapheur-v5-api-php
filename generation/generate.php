<?php

use IparapheurV5Client\Generate\Generate;

require_once __DIR__ . "/../vendor/autoload.php";

$json = json_decode(
    file_get_contents(__DIR__ . "/../exemples/openapi.json"),
    true,
    512,
    JSON_THROW_ON_ERROR
);

$model_dir = __DIR__ . "/../src/Model";


if (!is_dir($model_dir)) {
    if (!mkdir($model_dir, 0775, true) && !is_dir($model_dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $model_dir));
    }
}

$generate = new Generate();
$all_file = $generate->generate($json);

foreach ($all_file as $dtoId => $dtoContent) {
    file_put_contents($model_dir . "/" . $dtoId . ".php", $dtoContent);
}
