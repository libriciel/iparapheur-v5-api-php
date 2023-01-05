<?php

namespace IparapheurV5Client\Model;

class ListWorkflowDefinitionsQuery
{
    public int $page;
    public int $size;
    /** @var string[] */
    public array $sort;
    public string $searchTerm;
}