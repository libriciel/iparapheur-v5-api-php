<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\array;

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
        throw new IparapheurV5Exception('Method deleteMetadata not implemented');
    }
    public function createMetadata(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/metadata",
            $tenantId
        );
        throw new IparapheurV5Exception('Method createMetadata not implemented');
    }
    public function listInternalMetadataAsAdmin(): array
    {
        $path = sprintf(
            "/api/v1/admin/internalMetadata"
        );
        throw new IparapheurV5Exception('Method listInternalMetadataAsAdmin not implemented');
    }
}
