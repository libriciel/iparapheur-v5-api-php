<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Libriciel\IparapheurV5\App\ApiClientFactory;
use Libriciel\IparapheurV5\App\ApiExecutor;
use Libriciel\IparapheurV5\App\CliOptions;
use Libriciel\IparapheurV5\Client\Api\AdminTrashBinApi;

$cli = new CliOptions(
    ['tenant:', 'folder:'],
    ['tenant', 'folder']
);

$tenantId = $cli->get('tenant');
$folderId = $cli->get('folder');

[$httpClient, $config] = (new ApiClientFactory())->create();
$api = new AdminTrashBinApi($httpClient, $config);

if (!is_dir('downloads') && !mkdir('downloads', 0777, true) && !is_dir('downloads')) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'downloads'));
}

ApiExecutor::runBinary(
    static fn () => $api->downloadTrashBinFolderZip($tenantId, $folderId),
    "downloads/trashbin_folder_{$folderId}.zip",
    'ZIP téléchargé et sauvegardé avec succès.'
);
