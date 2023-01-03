<?php

namespace IparapheurV5Client\Model;

class ExternalSignatureConfig
{
    public string $id;
    public string $name;
    public string $serviceName;
    public string $url;
    public string $token;
    public ?string $password;
    public ?string $login;
    /** @var string[] */
    public array $transactionIds;
}