<?php

namespace IparapheurV5Client\Model;

class PageTenantRepresentation
{
    public int $totalElements;
    public int $totalPages;
    public int $size;
    /** @var TenantRepresentation[] */
    public array $content;
    public int $number;
    public SortObject $sort;
    public int $numberOfElements;
    public PageableObject $pageable;
    public bool $first;
    public bool $last;
    public bool $empty;
}
