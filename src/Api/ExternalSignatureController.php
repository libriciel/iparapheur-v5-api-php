<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\ExternalSignatureProcedure;

class ExternalSignatureController extends GenericObjectApi
{
    public function getProcedureData(
        string $tenantId,
        string $deskId,
        string $configId
    ): ExternalSignatureProcedure {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/external_signature/config/%s/procedure",
            $tenantId,
            $deskId,
            $configId
        );
        throw new IparapheurV5Exception('Method getProcedureData not implemented');
    }
}
