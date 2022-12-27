<?php

namespace IparapheurV5Client\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Client\Exception;
use IparapheurV5Client\Client;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Model\TokenQuery;
use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ClientTest extends TestCase
{
    public function testAuthenticate(): void
    {
        $clientInterface = (new Generator())->getMock(ClientInterface::class);
        $clientInterface
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) {
                if ($request->getUri() == 'https://foo/auth/realms/api/protocol/openid-connect/token') {
                    $file = __DIR__ . "/Api/fixtures/authenticate_ok.json";
                } else {
                    $file = __DIR__ . "/Api/fixtures/tenant_list.json";
                }
                return new Response(
                    200,
                    ['Content-type' => 'application/json'],
                    file_get_contents($file) ?: ""
                );
            });
        /** @var ClientInterface $clientInterface */
        $client = Client::createWithHttpClient($clientInterface);
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = 'foo';
        $tokenQuery->password = 'bar';
        $client->authenticate('https://foo', $tokenQuery);

        self::assertEquals(
            'Pastell',
            $client->tenant()->getList()->content[0]->name
        );
    }

    /**
     * @throws ExceptionInterface
     * @throws Exception
     */
    public function testException(): void
    {
        $clientInterface = (new Generator())->getMock(ClientInterface::class);
        $clientInterface
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                [],
                "Not found"
            ));
        /** @var ClientInterface $clientInterface */
        $client = Client::createWithHttpClient($clientInterface);
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = 'foo';
        $tokenQuery->password = 'bar';

        $this->expectException(IparapheurV5Exception::class);
        $this->expectExceptionMessage('{"body":"Not found"}');
        $client->authenticate('https://foo', $tokenQuery);
    }

    /**
     * @throws ExceptionInterface
     * @throws Exception
     */
    public function testExceptionWhenMessageInJson(): void
    {
        $clientInterface = (new Generator())->getMock(ClientInterface::class);
        $clientInterface
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-type' => 'application/json'],
                json_encode(['foo' => 'bar'], JSON_THROW_ON_ERROR) ?: ""
            ));
        /** @var ClientInterface $clientInterface */
        $client = Client::createWithHttpClient($clientInterface);
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = 'foo';
        $tokenQuery->password = 'bar';

        $this->expectException(IparapheurV5Exception::class);
        $this->expectExceptionMessage('{"body":{"foo":"bar"}}');
        $client->authenticate('https://foo', $tokenQuery);
    }

    /**
     * @throws ExceptionInterface
     * @throws Exception
     */
    public function testExceptionWhenNotJsonInJsonMessage(): void
    {
        $clientInterface = (new Generator())->getMock(ClientInterface::class);
        $clientInterface
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                [],
                json_encode(['foo' => 'bar'], JSON_THROW_ON_ERROR) ?: ""
            ));
        /** @var ClientInterface $clientInterface */
        $client = Client::createWithHttpClient($clientInterface);
        $tokenQuery = new TokenQuery();
        $tokenQuery->username = 'foo';
        $tokenQuery->password = 'bar';

        $this->expectException(IparapheurV5Exception::class);
        $this->expectExceptionMessage('Response is not in json');
        $client->authenticate('https://foo', $tokenQuery);
    }
}
