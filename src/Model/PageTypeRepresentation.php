<?php

namespace IparapheurV5Client\Model;

class PageTypeRepresentation
{
    public int $totalPages;
    public int $totalElements;
    public PageableObject $pageable;
    public int $numberOfElements;
    public int $size;
    /** @var TypeRepresentation[] */
    public array $content;
    public int $number;
    public SortObject $sort;
    public bool $first;
    public bool $last;
    public bool $empty;
}