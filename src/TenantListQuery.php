<?php

namespace IparapheurV5Client;

class TenantListQuery
{
    public int $page;
    public int $size;
    public string $sort;
    public bool $withAdminRights;
}
