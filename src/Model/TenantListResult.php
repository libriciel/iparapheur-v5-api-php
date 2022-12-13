<?php

namespace IparapheurV5Client\Model;

class TenantListResult
{
    public bool $last;
    public int $totalElement;
    public int $totalPages;
    public int $size;
    public int $number;
    public int $numberOfElements;
    public bool $first;
    public bool $empty;
    /** @var Tenant[] */
    public array $content = [];
    public Sort $sort;
    public Pageable $pageable;
}
