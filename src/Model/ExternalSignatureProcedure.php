<?php

namespace IparapheurV5Client\Model;

class ExternalSignatureProcedure
{
    public string $id;
    public string $name;
    public bool $started;
    public string $status;
    /** @var string[] */
    public array $metadata;
    /** @var ExternalSignatureMember[] */
    public array $members;
    /** @var ExternalSignatureDocument[] */
    public array $files;
    public bool $test;
}