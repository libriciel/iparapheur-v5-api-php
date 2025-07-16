<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\FolderApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:'],
    ['tenant', 'desk', 'folder']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$folderId = $cli->get('folder');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new FolderApi($httpClient, $config);

ApiExecutor::run(
    static fn() => $api->deleteFolder($tenantId, $deskId, $folderId),
    'Dossier supprimé avec succès.'
);