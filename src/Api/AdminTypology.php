<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTypologyRepresentation;
use IparapheurV5Client\Model\GetTypologyHierarchyQuery;

class AdminTypology extends GenericObjectApi
{
    public function deleteType(
        string $tenantId,
        string $typeId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type/%s",
            $tenantId,
            $typeId
        );
        throw new IparapheurV5Exception('Method deleteType not implemented');
    }
    public function deleteSubtype(
        string $tenantId,
        string $typeId,
        string $subtypeId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type/%s/subtype/%s",
            $tenantId,
            $typeId,
            $subtypeId
        );
        throw new IparapheurV5Exception('Method deleteSubtype not implemented');
    }
    public function createType(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type",
            $tenantId
        );
        throw new IparapheurV5Exception('Method createType not implemented');
    }
    public function createSubtype(
        string $tenantId,
        string $typeId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type/%s/subtype",
            $tenantId,
            $typeId
        );
        throw new IparapheurV5Exception('Method createSubtype not implemented');
    }
    public function getTypologyHierarchy(
        string $tenantId,
        GetTypologyHierarchyQuery $getTypologyHierarchyQuery = null
    ): PageTypologyRepresentation {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology",
            $tenantId
        );
        return $this->get($path, PageTypologyRepresentation::class, $getTypologyHierarchyQuery);
    }
}
