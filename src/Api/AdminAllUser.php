<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTenantRepresentation;
use IparapheurV5Client\Model\ListUserTenantsQuery;
use IparapheurV5Client\Model\ListUserAdministeredTenantsQuery;

class AdminAllUser extends GenericObjectApi
{
    public function listUserTenants(
        string $userId,
        ListUserTenantsQuery $listUserTenantsQuery = null
    ): PageTenantRepresentation {
        $path = sprintf(
            "/api/v1/admin/user/%s/tenant",
            $userId
        );
        return $this->get($path, PageTenantRepresentation::class, $listUserTenantsQuery);
    }
    public function listUserAdministeredTenants(
        string $userId,
        ListUserAdministeredTenantsQuery $listUserAdministeredTenantsQuery = null
    ): PageTenantRepresentation {
        $path = sprintf(
            "/api/v1/admin/user/%s/administeredTenants",
            $userId
        );
        return $this->get($path, PageTenantRepresentation::class, $listUserAdministeredTenantsQuery);
    }
    public function countLoggedInUsers(): int
    {
        $path = sprintf(
            "/api/v1/admin/user/count"
        );
        throw new IparapheurV5Exception('Method countLoggedInUsers not implemented');
    }
}
