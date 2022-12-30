<?php


require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTrashBin;
use IparapheurV5Client\Client;

/** @var Client $client */
$adminTrashBin = new AdminTrashBin($client);
$adminTrashBin->deleteTrashBinFolder($_ENV['TENANT_ID'], $_ENV['FOLDER_ID']);
