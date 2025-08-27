<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\FolderApi;

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
    static fn () => $api->deleteFolder($tenantId, $deskId, $folderId),
    'Dossier supprimé avec succès.'
);
