<?php

namespace IparapheurV5Client\Generate;

class QueryStructure
{
    public string $tagName;
    public string $method;
    public string $path;
    public string $operationId;
    public string $returnType;
    /** @var Properties[] */
    public array $pathInput = [];

    /** @var Properties[] */
    public array $queryInput = [];

    public string $requestBodyType = "";
}
