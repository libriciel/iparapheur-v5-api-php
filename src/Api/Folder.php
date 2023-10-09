<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageFolderRepresentation;
use IparapheurV5Client\Model\State;
use IparapheurV5Client\Model\ListFoldersQuery;

class Folder extends GenericObjectApi
{
    public function listFolders(
        string $tenantId,
        string $deskId,
        State $state,
        ListFoldersQuery $listFoldersQuery = null
    ): PageFolderRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/%s",
            $tenantId,
            $deskId,
            $state->value
        );
        return $this->get($path, PageFolderRepresentation::class, $listFoldersQuery);
    }
    public function downloadFolderZip(
        string $tenantId,
        string $deskId,
        string $folderId
    ): ResponseInterface {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/zip",
            $tenantId,
            $deskId,
            $folderId
        );
        return $this->getRaw($path);
    }
    public function downloadFolderPremis(
        string $tenantId,
        string $deskId,
        string $folderId
    ): ResponseInterface {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/premis",
            $tenantId,
            $deskId,
            $folderId
        );
        return $this->getRaw($path);
    }
    public function deleteFolder(
        string $tenantId,
        string $deskId,
        string $folderId
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s",
            $tenantId,
            $deskId,
            $folderId
        );
         $this->delete($path);
    }
}
