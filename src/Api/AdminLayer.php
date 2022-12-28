<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\LayerDto;

class AdminLayer extends GenericObjectApi
{
    public function deleteLayer(
        string $tenantId,
        string $layerId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer/%s",
            $tenantId,
            $layerId
        );
         $this->delete($path);
    }
    public function createLayer(
        string $tenantId,
        LayerDto $layerDto
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer",
            $tenantId
        );
          $this->post(
              path: $path,
              requestObject: $layerDto
          );
    }
    public function createFileStamp(
        string $tenantId,
        string $layerId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer/%s/stamp",
            $tenantId,
            $layerId
        );
          $this->post(
              path: $path
          );
    }
    public function getLayerExamplePdf(
        string $tenantId,
        LayerDto $layerDto
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer/examplePdf",
            $tenantId
        );
          return $this->post(
              path: $path,
              requestObject: $layerDto
          );
    }
    public function deleteFileStamp(
        string $tenantId,
        string $layerId,
        string $stampId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer/%s/stamp/%s",
            $tenantId,
            $layerId,
            $stampId
        );
         $this->delete($path);
    }
}
