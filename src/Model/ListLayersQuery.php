<?php

namespace IparapheurV5Client\Model;

class ListLayersQuery
{
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
}