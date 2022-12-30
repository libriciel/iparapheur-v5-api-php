<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\array;
use IparapheurV5Client\Model\MetadataDto;

class AdminMetadata extends GenericObjectApi
{
    public function deleteMetadata(
        string $tenantId,
        string $metadataId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/metadata/%s",
            $tenantId,
            $metadataId
        );
         $this->delete($path);
    }
    public function createMetadata(
        string $tenantId,
        MetadataDto $metadataDto
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/metadata",
            $tenantId
        );
          $this->post(
              path: $path,
              requestObject: $metadataDto
          );
    }
    public function listInternalMetadataAsAdmin(): array
    {
        $path = sprintf(
            "/api/v1/admin/internalMetadata"
        );
        throw new IparapheurV5Exception('Method listInternalMetadataAsAdmin not implemented');
    }
}
