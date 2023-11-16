<?php

namespace IparapheurV5Client\Model;

class PageableObject
{
    public int $pageNumber;
    public bool $unpaged;
    public int $pageSize;
    public bool $paged;
    public int $offset;
    public SortObject $sort;
}