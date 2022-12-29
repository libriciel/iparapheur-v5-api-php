<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\StartWorkflowResponse;

class Workflow extends GenericObjectApi
{
    public function visa(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/visa",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method visa not implemented');
    }
    public function undo(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/undo",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method undo not implemented');
    }
    public function transfer(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/transfer",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method transfer not implemented');
    }
    public function signature(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/sign",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method signature not implemented');
    }
    public function requestSecureMail(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/secure_mail",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method requestSecureMail not implemented');
    }
    public function secondOpinion(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/second_opinion",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method secondOpinion not implemented');
    }
    public function seal(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/seal",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method seal not implemented');
    }
    public function reject(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/reject",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method reject not implemented');
    }
    public function recycle(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/recycle",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method recycle not implemented');
    }
    public function paperSignature(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/paper_signature",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method paperSignature not implemented');
    }
    public function requestExternalSignatureProcedure(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/external_signature",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method requestExternalSignatureProcedure not implemented');
    }
    public function finalizeExternalSignature(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId,
        string $configId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/config/%s/external_signature/force",
            $tenantId,
            $deskId,
            $folderId,
            $taskId,
            $configId
        );
        throw new IparapheurV5Exception('Method finalizeExternalSignature not implemented');
    }
    public function chain(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/chain",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method chain not implemented');
    }
    public function bypass(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/bypass",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method bypass not implemented');
    }
    public function askSecondOpinion(
        string $tenantId,
        string $deskId,
        string $folderId,
        string $taskId
    ): void {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/folder/%s/task/%s/ask_second_opinion",
            $tenantId,
            $deskId,
            $folderId,
            $taskId
        );
        throw new IparapheurV5Exception('Method askSecondOpinion not implemented');
    }
    public function startWorkflow(
        string $tenantId,
        string $deskId,
        string $folderId
    ): StartWorkflowResponse {
        $path = sprintf(
            "/api/v1/tenant/%s/desk/%s/draft/%s",
            $tenantId,
            $deskId,
            $folderId
        );
        throw new IparapheurV5Exception('Method startWorkflow not implemented');
    }
}
