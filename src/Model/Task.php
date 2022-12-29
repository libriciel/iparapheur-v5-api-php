<?php

namespace IparapheurV5Client\Model;

class Task
{
    public string $id;
    /** @var string[] */
    public array $metadata;
    public Action $action;
    public Action $performedAction;
    public ExternalState $externalState;
    public State $state;
    /** @var DeskRepresentation[] */
    public array $desks;
    public DeskRepresentation $delegatedByDesk;
    public User $user;
    /** @var string[] */
    public array $readByUserIds;
    public string $publicCertificateBase64;
    public string $externalSignatureProcedureId;
    public \Datetime $beginDate;
    public \Datetime $date;
    public \Datetime $draftCreationDate;
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var DeskRepresentation[] */
    public array $notifiedDesks;
    public int $workflowIndex;
    public int $stepIndex;
    /** @var string[] */
    public array $mandatoryValidationMetadata;
    /** @var string[] */
    public array $mandatoryRejectionMetadata;
}
