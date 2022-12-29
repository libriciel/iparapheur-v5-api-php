<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTenantRepresentation;
use IparapheurV5Client\Model\TenantDto;
use IparapheurV5Client\Model\ListTenantsForUserQuery;

class Tenant extends GenericObjectApi
{
    public function listTenantsForUser(
        ListTenantsForUserQuery $listTenantsForUserQuery = null
    ): PageTenantRepresentation {
        $path = sprintf(
            "/api/v1/tenant"
        );
        return $this->get($path, PageTenantRepresentation::class, $listTenantsForUserQuery);
    }
    public function getTenant(
        string $tenantId
    ): TenantDto {
        $path = sprintf(
            "/api/v1/tenant/%s",
            $tenantId
        );
        return $this->get($path, TenantDto::class);
    }
}
