<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\CliOptions;
use App\ApiExecutor;
use OpenAPI\Client\Api\TenantApi;

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
    static fn() => $api->listTenants($page, $size, $sort),
    'Liste des tenants :'
);
