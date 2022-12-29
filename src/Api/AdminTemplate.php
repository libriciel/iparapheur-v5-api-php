<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\TemplateType;

class AdminTemplate extends GenericObjectApi
{
    public function deleteCustomTemplate(
        string $tenantId,
        TemplateType $templateType
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/templates/%s",
            $tenantId,
            $templateType->value
        );
        throw new IparapheurV5Exception('Method deleteCustomTemplate not implemented');
    }
    public function testMailTemplate(
        string $tenantId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/testMailTemplate",
            $tenantId
        );
        throw new IparapheurV5Exception('Method testMailTemplate not implemented');
    }
    public function testPdfTemplate(
        string $tenantId
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/testDocketPdfTemplate",
            $tenantId
        );
        throw new IparapheurV5Exception('Method testPdfTemplate not implemented');
    }
    public function getDefaultTemplate(
        TemplateType $templateType
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/admin/templates/%s",
            $templateType->value
        );
        return $this->getRaw($path);
    }
}
