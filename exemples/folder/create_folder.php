<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\FolderApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:', 'documents::'],
    ['tenant', 'desk', 'folder', 'documents']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$folderPath = $cli->get('folder');

$documentPaths = $cli->get('documents');
$documents = [];
if ($documentPaths) {
    foreach (explode(',', $documentPaths) as $path) {
        $documents[] = new SplFileObject(trim($path));
    }
}

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new FolderApi($httpClient, $config);

$folderFile = new SplFileObject($folderPath);
$autoStart = true;

ApiExecutor::run(
    static fn () => $api->createFolder($tenantId, $deskId, $folderFile, $documents, $autoStart),
    'Dossier créé avec succès :'
);
