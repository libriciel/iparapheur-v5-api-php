<?php

namespace IparapheurV5Client\Model;

class ListMetadataAsAdminQuery
{
    public bool $addInternalMetadata;
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
}