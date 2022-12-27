<?php

namespace IparapheurV5Client\Model;

class PageableObject
{
    public int $offset;
    public SortObject $sort;
    public int $pageNumber;
    public int $pageSize;
    public bool $unpaged;
    public bool $paged;
}
