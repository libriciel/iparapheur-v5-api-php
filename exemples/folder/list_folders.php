<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\FolderApi;
use Libriciel\IparapheurV5\Client\Model\State;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'state:', 'type_id::', 'subtype_id::', 'page::', 'size::', 'sort::'],
    ['tenant', 'desk', 'state']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$state = $cli->get('state');
$typeId = $cli->get('type_id');
$subtypeId = $cli->get('subtype_id');
$page = (int)($cli->get('page') ?? 0);
$size = (int)($cli->get('size') ?? 10);
$sort = $cli->get('sort') ? explode(',', $cli->get('sort')) : null;

$allowedStates = State::getAllowableEnumValues();

if (!in_array($state, $allowedStates, true)) {
    fwrite(STDERR, "Erreur : état invalide '$state'. États valides : " . implode(', ', $allowedStates) . "\n");
    exit(1);
}

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new FolderApi($httpClient, $config);

ApiExecutor::run(
    static fn () => $api->listFolders($tenantId, $deskId, $state, $typeId, $subtypeId, $page, $size, $sort),
    'Liste des dossiers :'
);
