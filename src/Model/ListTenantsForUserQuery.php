<?php

namespace IparapheurV5Client\Model;

class ListTenantsForUserQuery
{
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
    public bool $withAdminRights;
}