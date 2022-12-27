<?php

namespace IparapheurV5Client\Model;

class StepDefinitionDto
{
    public string $id;
    public Action $type;
    /** @var string[] */
    public array $validatingDeskIds;
    /** @var DeskRepresentation[] */
    public array $validatingDesks;
    /** @var string[] */
    public array $notifiedDeskIds;
    /** @var DeskRepresentation[] */
    public array $notifiedDesks;
    /** @var string[] */
    public array $mandatoryValidationMetadataIds;
    /** @var MetadataDto[] */
    public array $mandatoryValidationMetadata;
    /** @var string[] */
    public array $mandatoryRejectionMetadataIds;
    /** @var MetadataDto[] */
    public array $mandatoryRejectionMetadata;
    public StepDefinitionParallelType $parallelType;
}
