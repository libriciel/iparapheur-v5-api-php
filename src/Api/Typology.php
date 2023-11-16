<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTypeRepresentation;
use IparapheurV5Client\Model\PageSubtypeRepresentation;
use IparapheurV5Client\Model\ErrorResponse;
use IparapheurV5Client\Model\GetTypesQuery;
use IparapheurV5Client\Model\GetSubtypesQuery;
use IparapheurV5Client\Model\GetCreationAllowedSubtypesQuery;
use IparapheurV5Client\Model\GetCreationAllowedTypesQuery;

class Typology extends GenericObjectApi
{
    public function getTypes(
        string $tenantId,
        GetTypesQuery $getTypesQuery = null
    ): PageTypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/types",
            $tenantId
        );
        return $this->get($path, PageTypeRepresentation::class, $getTypesQuery);
    }
    public function getSubtypes(
        string $tenantId,
        string $typeId,
        GetSubtypesQuery $getSubtypesQuery = null
    ): PageSubtypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/types/%s/subtypes",
            $tenantId,
            $typeId
        );
        return $this->get($path, PageSubtypeRepresentation::class, $getSubtypesQuery);
    }
    public function getCreationAllowedSubtypes(
        string $tenantId,
        string $deskId,
        string $typeId,
        GetCreationAllowedSubtypesQuery $getCreationAllowedSubtypesQuery = null
    ): ErrorResponse {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/types/%s/subtypes/creation-allowed",
            $tenantId,
            $deskId,
            $typeId
        );
        return $this->get($path, ErrorResponse::class, $getCreationAllowedSubtypesQuery);
    }
    public function getCreationAllowedTypes(
        string $tenantId,
        string $deskId,
        GetCreationAllowedTypesQuery $getCreationAllowedTypesQuery = null
    ): PageTypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/types/creation-allowed",
            $tenantId,
            $deskId
        );
        return $this->get($path, PageTypeRepresentation::class, $getCreationAllowedTypesQuery);
    }
}
