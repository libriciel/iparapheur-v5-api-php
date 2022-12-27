<?php

namespace IparapheurV5Client\Model;

class TenantListQuery
{
    public int $page;
    public int $size;
    public string $sort;
    public bool $withAdminRights;
}
