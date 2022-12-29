<?php

namespace IparapheurV5Client\Api;

use Http\Client\Exception;
use IparapheurV5Client\Client;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\ResponseDeserializer;
use IparapheurV5Client\TokenQuery;
use IparapheurV5Client\TokenResult;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use function http_build_query;

class Authenticate
{
    public function __construct(
        private readonly Client $client
    ) {
    }

    /**
     * @throws IparapheurV5Exception
     * @throws ExceptionInterface|Exception
     */
    public function getToken(TokenQuery $tokenQuery): TokenResult
    {
        $normalizers = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $body = $normalizers->normalize($tokenQuery);
        if (! is_array($body)) {
            throw new IparapheurV5Exception("Token normalization failed");
        }
        $response = $this->client->post(
            '/auth/realms/api/protocol/openid-connect/token',
            [],
            http_build_query($body)
        );

        $tokenResult = (new ResponseDeserializer())->deserialize($response, TokenResult::class);
        if (! $tokenResult instanceof TokenResult) {
            throw new IparapheurV5Exception("Unexpected token response");
        }
        return $tokenResult;
    }
}
