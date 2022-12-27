<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;

class AdminFolder extends GenericObjectApi
{
    public function deleteFolderAsAdmin(
        string $tenantId,
        string $folderId
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/folder/%s",
            $tenantId,
            $folderId
        );
        throw new IparapheurV5Exception('Method deleteFolderAsAdmin not implemented');
    }
}
