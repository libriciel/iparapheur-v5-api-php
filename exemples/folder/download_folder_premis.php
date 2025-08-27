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

if (!is_dir('downloads') && !mkdir('downloads', 0777, true) && !is_dir('downloads')) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'downloads'));
}

ApiExecutor::runBinary(
    static fn () => $api->downloadFolderPremis($tenantId, $deskId, $folderId),
    "downloads/folder_{$folderId}_summary.xml",
    'Premis téléchargé et sauvegardé avec succès.'
);
