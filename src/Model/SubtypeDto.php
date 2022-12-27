<?php

namespace IparapheurV5Client\Model;

class SubtypeDto
{
    public string $id;
    public string $name;
    public string $description;
    public ?string $creationWorkflowId;
    public string $validationWorkflowId;
    public ?string $workflowSelectionScript;
    public bool $annotationsAllowed;
    public ?int $secureMailServerId;
    public ?string $sealCertificateId;
    public ?string $externalSignatureConfigId;
    public ExternalSignatureConfig $externalSignatureConfig;
    public bool $externalSignatureAutomatic;
    public ?string $creationPermittedDeskIds;
    public ?string $filterableByDeskIds;
    /** @var SubtypeMetadataDto[] */
    public array $subtypeMetadataList;
    /** @var SubtypeLayerDto[] */
    public array $subtypeLayerList;
    public bool $digitalSignatureMandatory;
    public bool $multiDocuments;
    public bool $readingMandatory;
    public bool $annexeIncluded;
    public bool $sealAutomatic;
}
