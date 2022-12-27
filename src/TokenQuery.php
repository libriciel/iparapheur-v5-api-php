<?php

namespace IparapheurV5Client;

class TokenQuery
{
    public string $username;
    public string $password;
    public readonly string $grantType;
    public readonly string $clientId;

    public function __construct()
    {
        $this->grantType = 'password';
        $this->clientId = 'ipcore-web';
    }
}
