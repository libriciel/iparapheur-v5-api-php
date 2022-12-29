<?php

namespace IparapheurV5Client\Model;

class WorkflowDefinitionDto
{
    public string $id;
    public string $key;
    public string $name;
    public int $version;
    public bool $isSuspended;
    public string $deploymentId;
    public int $usageCount;
    /** @var StepDefinitionDto[] */
    public array $steps;
    public string $finalDeskId;
    public DeskRepresentation $finalDesk;
    /** @var string[] */
    public array $finalNotifiedDeskIds;
    /** @var DeskRepresentation[] */
    public array $finalNotifiedDesks;
}