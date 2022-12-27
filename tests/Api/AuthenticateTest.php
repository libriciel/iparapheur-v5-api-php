<?php

namespace IparapheurV5Client\Tests\Api;

use IparapheurV5Client\Api\Authenticate;
use IparapheurV5Client\Tests\ClientMock;
use IparapheurV5Client\TokenQuery;
use PHPUnit\Framework\TestCase;

class AuthenticateTest extends TestCase
{
    public function testGetToken(): void
    {
        $client = (new ClientMock())->getClientWithJsonResponseOK(
            __DIR__ . "/fixtures/authenticate_ok.json"
        );
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = "foo";
        $tokenQuery->password = "bar";
        $token = (new Authenticate($client))->getToken($tokenQuery);
        self::assertEquals(900, $token->expiresIn);
    }
}
