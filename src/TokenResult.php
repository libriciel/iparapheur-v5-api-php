<?php

namespace IparapheurV5Client;

class TokenResult
{
    public string $accessToken;
    public int $expiresIn;
    public int $refreshExpiresIn;
    public string $refreshToken;
    public string $tokenType;
    public int $notBeforePolicy;
    public string $sessionState;
    public string $roles;
}
