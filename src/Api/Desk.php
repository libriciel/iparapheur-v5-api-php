<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\DelegationDto;

class Desk extends GenericObjectApi
{
    public function createDelegation(
        string $tenantId,
        string $deskId,
        DelegationDto $delegationDto
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/delegation",
            $tenantId,
            $deskId
        );
          $this->post(
              path: $path,
              requestObject: $delegationDto
          );
    }
    public function deleteDelegation(
        string $tenantId,
        string $deskId,
        string $delegationId,
        DelegationDto $delegationDto
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
