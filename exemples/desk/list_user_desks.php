<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\DeskApi;

$cli = new CliOptions(
    ['tenant:', 'page::', 'size::', 'sort::'],
    ['tenant']
);

$tenantId = $cli->get('tenant');
$page = (int)($cli->get('page') ?? 0);
$size = (int)($cli->get('size') ?? 10);
$sort = $cli->get('sort') ? explode(',', $cli->get('sort')) : null;

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new DeskApi($httpClient, $config);

ApiExecutor::run(
    static fn () => $api->listUserDesks($tenantId, $page, $size, $sort),
    'Liste des desks de l’utilisateur :'
);
