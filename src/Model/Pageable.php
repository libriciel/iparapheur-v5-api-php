<?php

namespace IparapheurV5Client\Model;

class Pageable
{
    public int $offset;
    public Sort $sort;
    public bool $unpaged;
    public int $pageSize;
    public bool $paged;
    public int $pageNumber;
}
