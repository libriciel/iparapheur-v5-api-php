<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\TenantDto;

class AdminTenant extends GenericObjectApi
{
    public function deleteTenant(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s",
            $tenantId
        );
         $this->delete($path);
    }
    public function createTenant(
        TenantDto $tenantDto
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant"
        );
          $this->post(
              path: $path,
              requestObject: $tenantDto
          );
    }
}
