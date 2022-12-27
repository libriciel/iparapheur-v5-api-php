<?php

namespace IparapheurV5Client\Model;

class PageDelegationDto
{
    public int $totalElements;
    public int $totalPages;
    public int $size;
    /** @var DelegationDto[] */
    public array $content;
    public int $number;
    public SortObject $sort;
    public int $numberOfElements;
    public PageableObject $pageable;
    public bool $first;
    public bool $last;
    public bool $empty;
}
