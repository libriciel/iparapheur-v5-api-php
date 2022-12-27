<?php

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\Tenant;
use IparapheurV5Client\Client;
use IparapheurV5Client\Model\ListTenantsForUserQuery;

/** @var Client $client */
$tenant = new Tenant($client);
$listTenantsForUserQuery = new ListTenantsForUserQuery();
$listTenantsForUserQuery->size=100;
$listTenantsForUserQuery->page=0;
print_r($tenant->listTenantsForUser($listTenantsForUserQuery));

print_r($tenant->getTenant($_ENV['TENANT_ID']));
