<?php


require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTrashBin;
use IparapheurV5Client\Client;

$folderId = 'ede9ac79-8508-11ed-9d51-0242c0a89013';

/** @var Client $client */
$adminTrashBin = new AdminTrashBin($client);

$result = $adminTrashBin->downloadTrashBinFolderZip($_ENV['TENANT_ID'], $folderId);

file_put_contents(__DIR__ . '/download/downloadTrashBinFolderZip.zip', $result->getBody()->getContents());
