<?php

declare(strict_types=1);

namespace IparapheurV5Client;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\ContentTypePlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Exception;
use IparapheurV5Client\Api\Authenticate;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\HttpClient\Builder;
use IparapheurV5Client\HttpClient\Plugin\Authentication;
use IparapheurV5Client\HttpClient\Plugin\ExceptionThrower;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class Client
{
    private const USER_AGENT = 'iparapheur-v5-api-php';
    private Builder $httpClientBuilder;

    public function __construct(string $url = null, Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $httpClientBuilder ?: new Builder();
        $this->httpClientBuilder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => self::USER_AGENT,
            ])
        );
        $this->httpClientBuilder->addPlugin(
            new ExceptionThrower()
        );
        $this->httpClientBuilder->addPlugin(
            new ContentTypePlugin()
        );
        if ($url) {
            $this->setUrl($url);
        }
    }

    public static function createWithHttpClient(ClientInterface $httpClient, string $url = null): self
    {
        $builder = new Builder($httpClient);
        return new self($url, $builder);
    }

    private function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    private function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    private function setUrl(string $url): void
    {
        $this->getHttpClientBuilder()->removePlugin(AddHostPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            new AddHostPlugin($this->getHttpClientBuilder()->getUriFactory()->createUri($url))
        );
    }

    /**
     * @throws Exception
     */
    public function get(string $uri, array $headers = []): ResponseInterface
    {
        return $this->getHttpClient()->get($uri, $headers);
    }

    /**
     * @throws Exception
     */
    public function post(string $uri, array $headers = [], string $body = ""): ResponseInterface
    {
        return $this->getHttpClient()->post($uri, $headers, $body);
    }

    /**
     * @throws Exception
     */
    public function delete(string $uri, array $headers = [], string $body = ""): ResponseInterface
    {
        return $this->getHttpClient()->delete($uri, $headers, $body);
    }

    /**
     * @throws ExceptionInterface
     * @throws IparapheurV5Exception
     * @throws Exception
     */
    public function authenticate(string $url, TokenQuery $tokenQuery): void
    {
        $this->setUrl($url);
        $tokenResult = (new Authenticate($this))->getToken($tokenQuery);
        $this->setAuthentication($tokenResult);
    }

    private function setAuthentication(TokenResult $tokenResult): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(
            new Authentication($tokenResult)
        );
    }
}
