<?php

namespace IparapheurV5Client\Tests;

use GuzzleHttp\Psr7\Response;
use IparapheurV5Client\Client;
use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class ClientMock
{
    public function getClientWithJsonResponseOK(string $fileWithJsonContent): Client
    {
        $clientInterface = (new Generator())->getMock(ClientInterface::class);
        $clientInterface
            ->expects(TestCase::once())
            ->method('sendRequest')
            ->willReturn(
                new Response(
                    200,
                    ['Content-type' => 'application/json'],
                    file_get_contents($fileWithJsonContent) ?: ""
                )
            );
        /** @var ClientInterface $clientInterface */
        return Client::createWithHttpClient($clientInterface);
    }
}
