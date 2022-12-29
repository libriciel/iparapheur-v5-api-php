<?php

namespace IparapheurV5Client\Model;

class MailParams
{
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var string[] */
    public array $metadata;
    /** @var string[] */
    public array $to;
    /** @var string[] */
    public array $cc;
    /** @var string[] */
    public array $bcc;
    public string $object;
    public string $message;
    public string $password;
    public string $payload;
    public bool $includeDocket;
}