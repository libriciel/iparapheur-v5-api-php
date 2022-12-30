<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\MailParams;
use IparapheurV5Client\Model\PrintFolderQuery;

class Folder extends GenericObjectApi
{
    public function deleteFolder(
        string $tenantId,
        string $folderId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/folder/%s",
            $tenantId,
            $folderId
        );
         $this->delete($path);
    }
    public function sendFolder(
        string $tenantId,
        string $folderId,
        MailParams $mailParams
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/folder/%s/mail",
            $tenantId,
            $folderId
        );
          $this->post(
              path: $path,
              requestObject: $mailParams
          );
    }
    public function downloadFolderZip(
        string $tenantId,
        string $folderId
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/tenant/%s/folder/%s/zip",
            $tenantId,
            $folderId
        );
        return $this->getRaw($path);
    }
    public function printFolder(
        string $tenantId,
        string $folderId,
        PrintFolderQuery $printFolderQuery = null
    ): ResponseInterface {
        $path = sprintf(
            "/api/v1/tenant/%s/folder/%s/print",
            $tenantId,
            $folderId
        );
        return $this->getRaw($path);
    }
}
