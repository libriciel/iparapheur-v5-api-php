<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\TenantApi;

$cli = new CliOptions(
    ['page::', 'size::', 'sort::'],
    []
);

$page = (int)($cli->get('page') ?? 0);
$size = (int)($cli->get('size') ?? 10);
$sort = $cli->get('sort') ? explode(',', $cli->get('sort')) : null;

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new TenantApi($httpClient, $config);

ApiExecutor::run(
    static fn () => $api->listTenants($page, $size, $sort),
    'Liste des tenants :'
);
