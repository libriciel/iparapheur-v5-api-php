<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\AdminTrashBinApi;

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
    static fn () => $api->listTrashBinFolders($tenantId, $folderId),
    'Dossier supprimé de la corbeille avec succès.'
);
