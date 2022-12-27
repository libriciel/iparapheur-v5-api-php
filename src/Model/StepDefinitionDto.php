<?php

namespace IparapheurV5Client\Model;

class StepDefinitionDto
{
    public string $id;
    public Action $type;
    public string $validatingDeskIds;
    /** @var DeskRepresentation[] */
    public array $validatingDesks;
    public string $notifiedDeskIds;
    /** @var DeskRepresentation[] */
    public array $notifiedDesks;
    public string $mandatoryValidationMetadataIds;
    /** @var MetadataDto[] */
    public array $mandatoryValidationMetadata;
    public string $mandatoryRejectionMetadataIds;
    /** @var MetadataDto[] */
    public array $mandatoryRejectionMetadata;
    public StepDefinitionParallelType $parallelType;
}
