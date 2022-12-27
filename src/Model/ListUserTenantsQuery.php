<?php

namespace IparapheurV5Client\Model;

class ListUserTenantsQuery
{
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
    public string $searchTerm;
    public bool $reverse;
}
