<?php

namespace IparapheurV5Client\Model;

class FolderRepresentation
{
    public string $id;
    public string $name;
    public ?\Datetime $dueDate;
    public \Datetime $draftCreationDate;
    public TypeDto $type;
    public SubtypeDto $subtype;
    public DeskRepresentation $originDesk;
    public DeskRepresentation $finalDesk;
    /** @var string[] */
    public array $metadata;
    public bool $readByCurrentUser;
}