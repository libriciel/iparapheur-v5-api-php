<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

class AdminTenant extends GenericObjectApi
{
    public function deleteTenant(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s",
            $tenantId
        );
        throw new IparapheurV5Exception('Method deleteTenant not implemented');
    }
    public function createTenant(): void
    {
        $path = sprintf(
            "/api/v1/admin/tenant"
        );
        throw new IparapheurV5Exception('Method createTenant not implemented');
    }
}
