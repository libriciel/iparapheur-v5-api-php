<?php

namespace IparapheurV5Client\Model;

class PageableObject
{
    public bool $unpaged;
    public int $pageNumber;
    public int $pageSize;
    public bool $paged;
    public int $offset;
    public SortObject $sort;
}