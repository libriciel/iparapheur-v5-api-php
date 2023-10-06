<?php

declare(strict_types=1);

namespace IparapheurV5Client\Tests\Api;

use Http\Client\Exception;
use IparapheurV5Client\Authenticate;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Tests\ClientMock;
use IparapheurV5Client\TokenQuery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class AuthenticateTest extends TestCase
{
    /**
     * @throws Exception
     * @throws ExceptionInterface
     * @throws IparapheurV5Exception
     */
    public function testGetToken(): void
    {
        $client = (new ClientMock())->getClientWithJsonResponseOK(
            __DIR__ . '/fixtures/authenticate_ok.json'
        );
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = 'foo';
        $tokenQuery->password = 'bar';
        $token = (new Authenticate($client))->getToken($tokenQuery);
        self::assertSame(900, $token->expiresIn);
    }
}
