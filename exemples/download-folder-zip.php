<?php

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTrashBin;
use IparapheurV5Client\Client;

/** @var Client $client */
$adminTrashBin = new AdminTrashBin($client);

$result = $adminTrashBin->downloadTrashBinFolderZip($_ENV['TENANT_ID'], $_ENV['FOLDER_ID']);

file_put_contents(__DIR__ . '/download/downloadTrashBinFolderZip.zip', $result->getBody()->getContents());
