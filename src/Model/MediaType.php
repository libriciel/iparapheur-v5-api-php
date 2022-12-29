<?php

namespace IparapheurV5Client\Model;

class MediaType
{
    public string $type;
    public string $subtype;
    /** @var string[] */
    public array $parameters;
    public float $qualityValue;
    public bool $wildcardType;
    public bool $wildcardSubtype;
    public string $subtypeSuffix;
    public string $charset;
    public bool $concrete;
}