<?php

namespace IparapheurV5Client\Model;

class TransferTaskParams
{
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var string[] */
    public array $metadata;
    public string $targetDeskId;
}