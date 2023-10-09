<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\SimpleTaskParams;
use IparapheurV5Client\Model\MailParams;

class Workflow extends GenericObjectApi
{
    public function undo(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/task/%s/undo",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method undo not implemented');
    }
    public function start(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId,
        SimpleTaskParams $simpleTaskParams
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/task/%s/start",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method start not implemented');
    }
    public function sendToTrashBin(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/task/%s/send_to_trash_bin",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method sendToTrashBin not implemented');
    }
    public function requestSecureMail(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId,
        MailParams $mailParams
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/task/%s/secure_mail",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method requestSecureMail not implemented');
    }
    public function bypass(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk/%s/folder/%s/task/%s/bypass",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method bypass not implemented');
    }
}
