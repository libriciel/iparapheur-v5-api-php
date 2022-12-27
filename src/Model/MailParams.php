<?php

namespace IparapheurV5Client\Model;

class MailParams
{
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var string[] */
    public array $metadata;
    public string $to;
    public string $cc;
    public string $bcc;
    public string $object;
    public string $message;
    public string $password;
    public string $payload;
    public bool $includeDocket;
}
