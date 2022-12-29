<?php

namespace IparapheurV5Client\Model;

class SubtypeMetadataDto
{
    public string $metadataId;
    public MetadataDto $metadata;
    public string $defaultValue;
    public bool $mandatory;
    public bool $editable;
}