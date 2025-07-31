<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\AdminTrashBinApi;

$cli = new CliOptions(
    ['tenant:', 'page::', 'size::'],
    ['tenant']
);

$tenantId = $cli->get('tenant');
$page = $cli->get('page') ?? 0;
$size = $cli->get('size') ?? 10;

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new AdminTrashBinApi($httpClient, $config);

ApiExecutor::run(
    static fn () => $api->listTrashBinFolders($tenantId, $page, $size),
    'Liste des dossiers dans la corbeille :'
);
