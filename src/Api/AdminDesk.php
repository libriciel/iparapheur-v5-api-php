<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

class AdminDesk extends GenericObjectApi
{
    public function createDelegationAsAdmin(
        string $tenantId,
        string $deskId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/desk/%s/delegation",
            $tenantId,
            $deskId
        );
        throw new IparapheurV5Exception('Method createDelegationAsAdmin not implemented');
    }
    public function deleteDelegationAsAdmin(
        string $tenantId,
        string $deskId,
        string $delegationId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/desk/%s/delegation/%s",
            $tenantId,
            $deskId,
            $delegationId
        );
         $this->delete($path);
    }
}
