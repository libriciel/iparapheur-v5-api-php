<?php

namespace IparapheurV5Client\Model;

class WorkflowDefinitionRepresentation
{
    public string $id;
    public string $key;
    public string $name;
    public int $version;
    public bool $isSuspended;
    public string $deploymentId;
    public int $usageCount;
}
