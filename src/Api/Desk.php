<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

class Desk extends GenericObjectApi
{
    public function createDelegation(
        string $tenantId,
        string $deskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/delegation",
            $tenantId,
            $deskId
        );
        throw new IparapheurV5Exception('Method createDelegation not implemented');
    }
    public function deleteDelegation(
        string $tenantId,
        string $deskId,
        string $delegationId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/delegation/%s",
            $tenantId,
            $deskId,
            $delegationId
        );
         $this->delete($path);
    }
}
