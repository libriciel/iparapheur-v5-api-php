<?php

namespace IparapheurV5Client\Model;

class ListTenantsQuery
{
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
}
