<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

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
        throw new IparapheurV5Exception('Method deleteLayer not implemented');
    }
    public function createLayer(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer",
            $tenantId
        );
        throw new IparapheurV5Exception('Method createLayer not implemented');
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
        throw new IparapheurV5Exception('Method createFileStamp not implemented');
    }
    public function getLayerExamplePdf(
        string $tenantId
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/layer/examplePdf",
            $tenantId
        );
        throw new IparapheurV5Exception('Method getLayerExamplePdf not implemented');
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
        throw new IparapheurV5Exception('Method deleteFileStamp not implemented');
    }
}
