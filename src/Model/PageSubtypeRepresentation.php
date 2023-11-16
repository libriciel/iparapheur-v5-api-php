<?php

namespace IparapheurV5Client\Model;

class PageSubtypeRepresentation
{
    public int $totalPages;
    public int $totalElements;
    public PageableObject $pageable;
    public int $numberOfElements;
    public int $size;
    /** @var SubtypeRepresentation[] */
    public array $content;
    public int $number;
    public SortObject $sort;
    public bool $first;
    public bool $last;
    public bool $empty;
}