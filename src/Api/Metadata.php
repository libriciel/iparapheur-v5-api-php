<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageMetadataRepresentation;
use IparapheurV5Client\Model\MetadataDto;
use IparapheurV5Client\Model\ListMetadataQuery;

class Metadata extends GenericObjectApi
{
    public function listMetadata(
        string $tenantId,
        ListMetadataQuery $listMetadataQuery = null
    ): PageMetadataRepresentation {
        $path = sprintf(
            "/api/v1/tenant/%s/metadata",
            $tenantId
        );
        return $this->get($path, PageMetadataRepresentation::class, $listMetadataQuery);
    }
    public function getMetadata(
        string $tenantId,
        string $metadataId
    ): MetadataDto {
        $path = sprintf(
            "/api/v1/tenant/%s/metadata/%s",
            $tenantId,
            $metadataId
        );
        return $this->get($path, MetadataDto::class);
    }
}
