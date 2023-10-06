<?php

declare(strict_types=1);

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\Tenant;
use IparapheurV5Client\Client;

/** @var Client $client */
$tenant = new Tenant($client);
print_r($tenant->listTenants());
