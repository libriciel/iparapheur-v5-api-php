<?php

namespace IparapheurV5Client\Model;

class PageableObject
{
    public int $offset;
    public SortObject $sort;
    public int $pageSize;
    public bool $paged;
    public int $pageNumber;
    public bool $unpaged;
}