<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\WorkflowApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:', 'task:'],
    ['tenant', 'desk', 'folder', 'task']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$folderId = $cli->get('folder');
$taskId = $cli->get('task');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new WorkflowApi($httpClient, $config);

ApiExecutor::run(
    static fn () => $api->sendToTrashBinWithHttpInfo($tenantId, $deskId, $folderId, $taskId),
    "Dossier envoyé à la corbeille."
);
