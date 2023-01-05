<?php

namespace IparapheurV5Client\Model;

class GetTypologyHierarchyQuery
{
    public bool $collapseAll;
    /** @var string[] */
    public array $reverseIdList;
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
    public string $searchTerm;
}