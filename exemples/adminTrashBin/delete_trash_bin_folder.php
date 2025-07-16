<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\AdminTrashBinApi;

$cli = new CliOptions(
    ['tenant:', 'folder:'],
    ['tenant', 'folder']
);

$tenantId = $cli->get('tenant');
$folderId = $cli->get('folder');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new AdminTrashBinApi($httpClient, $config);

$api->deleteTrashBinFolder($tenantId, $folderId);

ApiExecutor::run(
    static fn() => $api->listTrashBinFolders($tenantId, $folderId),
    'Dossier supprimé de la corbeille avec succès.'
);