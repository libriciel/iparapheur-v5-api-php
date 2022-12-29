<?php

use IparapheurV5Client\Generate\GenerateClass;

require_once __DIR__ . "/../vendor/autoload.php";

$generateClass = new GenerateClass();
$all_file = $generateClass->generate();
foreach ($all_file as $filename => $filecontent) {
    file_put_contents($filename, $filecontent);
}
