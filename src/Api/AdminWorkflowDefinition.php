<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\WorkflowDefinitionDto;

class AdminWorkflowDefinition extends GenericObjectApi
{
    public function updateWorkflowDefinition(
        string $tenantId,
        string $workflowDefinitionId
    ): WorkflowDefinitionDto {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/workflowDefinition/%s",
            $tenantId,
            $workflowDefinitionId
        );
        throw new IparapheurV5Exception('Method updateWorkflowDefinition not implemented');
    }
    public function createWorkflowDefinition(
        string $tenantId
    ): WorkflowDefinitionDto {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/workflowDefinition",
            $tenantId
        );
        throw new IparapheurV5Exception('Method createWorkflowDefinition not implemented');
    }
    public function getWorkflowDefinitionByKey(
        string $tenantId,
        string $key
    ): WorkflowDefinitionDto {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/workflowDefinitionByKey/%s",
            $tenantId,
            $key
        );
        return $this->get($path, WorkflowDefinitionDto::class);
    }
    public function deleteWorkflowDefinition(
        string $tenantId,
        string $workflowDefinitionKey
    ): void {
        $path = sprintf(
            "/api/v1/admin/tenant/%s/workflowDefinition/%s",
            $tenantId,
            $workflowDefinitionKey
        );
        throw new IparapheurV5Exception('Method deleteWorkflowDefinition not implemented');
    }
}
