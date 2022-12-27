<?php

namespace IparapheurV5Client;

use Http\Client\Exception;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GenericObjectApi
{
    public function __construct(
        private readonly Client $client
    ) {
    }

    /**
     * @throws Exception
     * @throws IparapheurV5Exception
     */
    public function get(string $path, string $returnClassName, object $queryObject = null)
    {
        if ($queryObject) {
            $encoders = [new UrlEncoder()];
            $normalizers = [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())];
            $serializer = (new Serializer($normalizers, $encoders));
            $queryPart = $serializer->serialize($queryObject, 'url');
            $path .= "?$queryPart";
        }

        $result = $this->client->get($path);
        $deserializedResult = (new ResponseDeserializer())
            ->deserialize($result, $returnClassName);
        if (! $deserializedResult instanceof $returnClassName) {
            throw new IparapheurV5Exception("Unexpected token response");
        }
        return $deserializedResult;
    }

    /**
     * @throws Exception
     */
    public function getRaw(string $path): ResponseInterface
    {
        return $this->client->get($path);
    }
}
