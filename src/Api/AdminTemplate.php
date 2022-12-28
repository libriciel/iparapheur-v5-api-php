<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\TemplateType;
use IparapheurV5Client\Model\TemplateTestRequest;

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
         $this->delete($path);
    }
    public function testMailTemplate(
        string $tenantId,
        TemplateTestRequest $templateTestRequest
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/testMailTemplate",
            $tenantId
        );
          $this->post(
              path: $path,
              requestObject: $templateTestRequest
          );
    }
    public function testPdfTemplate(
        string $tenantId,
        TemplateTestRequest $templateTestRequest
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/testDocketPdfTemplate",
            $tenantId
        );
          return $this->post(
              path: $path,
              requestObject: $templateTestRequest
          );
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
