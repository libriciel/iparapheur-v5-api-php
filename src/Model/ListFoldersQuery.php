<?php

namespace IparapheurV5Client\Model;

class ListFoldersQuery
{
    public string $typeId;
    public string $subtypeId;
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
}
