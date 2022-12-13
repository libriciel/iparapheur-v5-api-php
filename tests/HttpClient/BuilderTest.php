<?php

declare(strict_types=1);

namespace IparapheurV5Client\Tests\HttpClient;

use Http\Client\Common\Plugin;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use IparapheurV5Client\HttpClient\Builder;
use PHPUnit\Framework\TestCase;

final class BuilderTest extends TestCase
{
    private Builder $builder;

    public function setUp(): void
    {
        $this->builder = new Builder(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(StreamFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class),
        );
    }

    public function testAddPluginShouldInvalidateHttpClient(): void
    {
        $client = $this->builder->getHttpClient();
        $this->builder->addPlugin($this->createMock(Plugin::class));
        $this->assertNotSame($client, $this->builder->getHttpClient());
    }

    public function testRemovePluginShouldInvalidateHttpClient(): void
    {
        $this->builder->addPlugin($this->createMock(Plugin::class));
        $client = $this->builder->getHttpClient();
        $this->builder->removePlugin(Plugin::class);
        $this->assertNotSame($client, $this->builder->getHttpClient());
    }
}
