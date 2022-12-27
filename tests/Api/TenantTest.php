<?php

namespace IparapheurV5Client\Tests\Api;

use Http\Client\Exception;
use IparapheurV5Client\Api\Tenant;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Model\ListTenantsForUserQuery;
use IparapheurV5Client\Tests\ClientMock;
use PHPUnit\Framework\TestCase;

class TenantTest extends TestCase
{
    /**
     * @throws Exception
     * @throws IparapheurV5Exception
     */
    public function testGetToken(): void
    {
        $client = (new ClientMock())->getClientWithJsonResponseOK(
            __DIR__ . "/fixtures/tenant_list.json"
        );
        $listTenantForUserQuery = new ListTenantsForUserQuery();
        $listTenantForUserQuery->page = 0;
        $listTenantForUserQuery->size = 10;
        $listTenantForUserQuery->sort = ['NAME,ASC'];
        $listTenantForUserQuery->withAdminRights = false;
        $tenant = new Tenant($client);
        $tenantResult = $tenant->listTenantsForUser($listTenantForUserQuery);
        self::assertEquals('Pastell', $tenantResult->content[0]->name);
    }
}
