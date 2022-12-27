<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

class AdminSealCertificate extends GenericObjectApi
{
    public function deleteSealCertificate(
        string $tenantId,
        string $sealCertificateId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/sealCertificate/%s",
            $tenantId,
            $sealCertificateId
        );
        throw new IparapheurV5Exception('Method deleteSealCertificate not implemented');
    }
    public function createSealCertificate(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/sealCertificate",
            $tenantId
        );
        throw new IparapheurV5Exception('Method createSealCertificate not implemented');
    }
}
