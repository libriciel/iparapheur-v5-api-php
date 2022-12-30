<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageTypologyRepresentation;
use IparapheurV5Client\Model\TypeDto;
use IparapheurV5Client\Model\SubtypeDto;
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
         $this->delete($path);
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
         $this->delete($path);
    }
    public function createType(
        string $tenantId,
        TypeDto $typeDto
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type",
            $tenantId
        );
          $this->post(
              path: $path,
              requestObject: $typeDto
          );
    }
    public function createSubtype(
        string $tenantId,
        string $typeId,
        SubtypeDto $subtypeDto
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/typology/type/%s/subtype",
            $tenantId,
            $typeId
        );
          $this->post(
              path: $path,
              requestObject: $subtypeDto
          );
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
