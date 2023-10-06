<?php

declare(strict_types=1);

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTrashBin;
use IparapheurV5Client\Client;
use IparapheurV5Client\Model\ListTrashBinFoldersQuery;

/** @var Client $client */
$adminTrashBin = new AdminTrashBin($client);

$listTrashBinFolderQuery = new ListTrashBinFoldersQuery();
$listTrashBinFolderQuery->size = 10;
$listTrashBinFolderQuery->page = 0;
print_r($adminTrashBin->listTrashBinFolders($_ENV['TENANT_ID'], $listTrashBinFolderQuery));


