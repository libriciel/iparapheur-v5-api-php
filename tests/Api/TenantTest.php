<?php

namespace IparapheurV5Client\Tests\Api;

use Http\Client\Exception;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Model\TenantListQuery;
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
        $tenantQuery = new TenantListQuery();
        $tenantQuery->page = 0;
        $tenantQuery->size = 10;
        $tenantQuery->sort = 'NAME,ASC';
        $tenantQuery->withAdminRights = false;

        $tenantResult = $client->tenant()->getList($tenantQuery);
        self::assertEquals('Pastell', $tenantResult->content[0]->name);
    }
}
