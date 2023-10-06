<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTenantRepresentation;
use IparapheurV5Client\Model\ListTenantsQuery;

class Tenant extends GenericObjectApi
{
    public function listTenants(
        ListTenantsQuery $listTenantsQuery = null
    ): PageTenantRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant"
        );
        return $this->get($path, PageTenantRepresentation::class, $listTenantsQuery);
    }
}
