<?php

namespace IparapheurV5Client\Model;

class FolderDto
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
    public bool $readByCurrentUser;
}
