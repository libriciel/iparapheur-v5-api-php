<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTypeRepresentation;
use IparapheurV5Client\Model\PageSubtypeRepresentation;
use IparapheurV5Client\Model\ListTypesQuery;
use IparapheurV5Client\Model\ListSubtypesQuery;
use IparapheurV5Client\Model\ListCreationAllowedSubtypesQuery;
use IparapheurV5Client\Model\ListCreationAllowedTypesQuery;

class Typology extends GenericObjectApi
{
    public function listTypes(
        string $tenantId,
        ListTypesQuery $listTypesQuery = null
    ): PageTypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/types",
            $tenantId
        );
        return $this->get($path, PageTypeRepresentation::class, $listTypesQuery);
    }
    public function listSubtypes(
        string $tenantId,
        string $typeId,
        ListSubtypesQuery $listSubtypesQuery = null
    ): PageSubtypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/types/%s/subtypes",
            $tenantId,
            $typeId
        );
        return $this->get($path, PageSubtypeRepresentation::class, $listSubtypesQuery);
    }
    public function listCreationAllowedSubtypes(
        string $tenantId,
        string $deskId,
        string $typeId,
        ListCreationAllowedSubtypesQuery $listCreationAllowedSubtypesQuery = null
    ): PageSubtypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/types/%s/subtypes/creation-allowed",
            $tenantId,
            $deskId,
            $typeId
        );
        return $this->get($path, PageSubtypeRepresentation::class, $listCreationAllowedSubtypesQuery);
    }
    public function listCreationAllowedTypes(
        string $tenantId,
        string $deskId,
        ListCreationAllowedTypesQuery $listCreationAllowedTypesQuery = null
    ): PageTypeRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/types/creation-allowed",
            $tenantId,
            $deskId
        );
        return $this->get($path, PageTypeRepresentation::class, $listCreationAllowedTypesQuery);
    }
}
