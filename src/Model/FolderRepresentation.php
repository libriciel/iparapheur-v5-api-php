<?php

namespace IparapheurV5Client\Model;

class FolderRepresentation
{
    public string $id;
    public string $name;
    public ?\Datetime $dueDate;
    /** @var string[] */
    public array $metadata;
}