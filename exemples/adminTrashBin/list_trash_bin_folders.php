<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\AdminTrashBinApi;

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
    static fn() => $api->listTrashBinFolders($tenantId, $page, $size),
    'Liste des dossiers dans la corbeille :'
);
