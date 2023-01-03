<?php

namespace IparapheurV5Client\Model;

class MetadataDto
{
    public string $id;
    public string $name;
    public string $key;
    public int $index;
    public MetadataType $type;
    /** @var string[] */
    public array $restrictedValues;
}