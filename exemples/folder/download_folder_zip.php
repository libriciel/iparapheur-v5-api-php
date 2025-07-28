<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\ApiClientFactory;
use App\ApiExecutor;
use App\CliOptions;
use OpenAPI\Client\Api\FolderApi;

$cli = new CliOptions(
    ['tenant:', 'desk:', 'folder:'],
    ['tenant', 'desk', 'folder']
);

$tenantId = $cli->get('tenant');
$deskId = $cli->get('desk');
$folderId = $cli->get('folder');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new FolderApi($httpClient, $config);

if (!is_dir('downloads') && !mkdir('downloads', 0777, true) && !is_dir('downloads')) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'downloads'));
}

ApiExecutor::runBinary(
    static fn () => $api->downloadFolderZip($tenantId, $deskId, $folderId),
    "downloads/folder_{$folderId}.zip",
    'ZIP téléchargé et sauvegardé avec succès.'
);
