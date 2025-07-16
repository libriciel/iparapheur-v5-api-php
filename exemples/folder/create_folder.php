<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\FolderApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:', 'document::'],
    ['tenant', 'desk', 'folder']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$folderPath = $cli->get('folder');
$documentPath = $cli->get('document');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new FolderApi($httpClient, $config);

$folderFile = new SplFileObject($folderPath);
$documents = $documentPath ? [new SplFileObject($documentPath)] : [];

$autoStart = true;

ApiExecutor::run(
    static fn () => $api->createFolder($tenantId, $deskId, $folderFile, $documents, $autoStart),
    'Dossier créé avec succès :'
);
