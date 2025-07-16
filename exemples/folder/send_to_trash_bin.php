<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\CliOptions;
use App\ApiExecutor;
use OpenAPI\Client\Api\WorkflowApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:', 'task:'],
    ['tenant', 'desk', 'folder', 'task']
);

$tenantId = $cli->get('tenant');
$deskId   = $cli->get('desk');
$folderId = $cli->get('folder');
$taskId   = $cli->get('task');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new WorkflowApi($httpClient, $config);

ApiExecutor::run(
    static fn() => $api->sendToTrashBinWithHttpInfo($tenantId, $deskId, $folderId, $taskId),
    "Dossier envoyé à la corbeille."
);
