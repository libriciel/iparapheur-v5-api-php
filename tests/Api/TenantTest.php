<?php

declare(strict_types=1);

namespace IparapheurV5Client\Tests\Api;

use IparapheurV5Client\Api\Tenant;
use IparapheurV5Client\Tests\ClientMock;
use PHPUnit\Framework\TestCase;

class TenantTest extends TestCase
{
    public function testGetToken(): void
    {
        $client = (new ClientMock())->getClientWithJsonResponseOK(
            __DIR__ . '/fixtures/tenant_list.json'
        );
        $tenant = new Tenant($client);
        $tenantResult = $tenant->listTenants();
        self::assertSame('Pastell', $tenantResult->content[0]->name);
    }
}
