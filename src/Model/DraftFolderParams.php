<?php

namespace IparapheurV5Client\Model;

class DraftFolderParams
{
    public string $id;
    public string $name;
    public \Datetime $dueDate;
    public \Datetime $draftCreationDate;
    public TypeDto $type;
    public SubtypeDto $subtype;
    public DeskRepresentation $originDesk;
    public DeskRepresentation $finalDesk;
    /** @var string[] */
    public array $metadata;
    public string $typeId;
    public string $subtypeId;
    /** @var Task[] */
    public array $stepList;
    /** @var DocumentDto[] */
    public array $documentList;
    /** @var string[] */
    public array $readByUserIds;
    /** @var string[] */
    public array $variableDesksIds;
    /** @var array[] */
    public array $detachedSignaturesMapping;
    public string $legacyId;
    public string $visibility;
    public bool $readByCurrentUser;
}