<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageFolderRepresentation;
use IparapheurV5Client\Model\ListTrashBinFoldersQuery;

class AdminTrashBin extends GenericObjectApi
{
    public function listTrashBinFolders(
        string $tenantId,
        ListTrashBinFoldersQuery $listTrashBinFoldersQuery = null
    ): PageFolderRepresentation {
        $path = sprintf(
            "/api/v1/tenant/%s/archive",
            $tenantId
        );
        return $this->get($path, PageFolderRepresentation::class, $listTrashBinFoldersQuery);
    }
    public function downloadTrashBinFolderZip(
        string $tenantId,
        string $folderId
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/tenant/%s/archive/%s/zip",
            $tenantId,
            $folderId
        );
        return $this->getRaw($path);
    }
    public function deleteTrashBinFolder(
        string $tenantId,
        string $folderId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/archive/%s",
            $tenantId,
            $folderId
        );
        throw new IparapheurV5Exception('Method deleteTrashBinFolder not implemented');
    }
}
