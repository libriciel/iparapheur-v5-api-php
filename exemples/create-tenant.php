<?php

require_once __DIR__ . '/init.php';

use IparapheurV5Client\Api\AdminTenant;
use IparapheurV5Client\Client;
use IparapheurV5Client\Model\TenantDto;

$tenantDto = new TenantDto();
$tenantDto->name = "Mon beau tenant";
$tenantDto->id = uniqid('', true);
/** @var Client $client */
$adminTenant = new AdminTenant($client);

$adminTenant->createTenant($tenantDto);