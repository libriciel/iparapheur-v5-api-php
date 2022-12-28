<?php

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTenant;
use IparapheurV5Client\Client;
use IparapheurV5Client\Model\TenantDto;

$folderId = 'ede9ac79-8508-11ed-9d51-0242c0a89013';

$tenantDto = new TenantDto();
$tenantDto->name = "Mon beau tenant";
$tenantDto->id = uniqid('', true);
/** @var Client $client */
$adminTenant = new AdminTenant($client);

$adminTenant->createTenant($tenantDto);