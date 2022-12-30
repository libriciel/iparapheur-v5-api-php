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
    protected function get(string $path, string $returnClassName, object $queryObject = null)
    {
        if ($queryObject) {
            $encoders = [new UrlEncoder()];
            $normalizers = [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())];
            $serializer = (new Serializer($normalizers, $encoders));
            $queryPart = $serializer->serialize($queryObject, 'url');
            $path .= "?$queryPart";
        }

        $result = $this->client->get($path);
        return $this->deserialize($result, $returnClassName);
    }

    private function deserialize(ResponseInterface $result, string $returnClassName): mixed
    {
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
    public function post(string $path, string $returnClassName = "", object $requestObject = null)
    {
        if ($requestObject) {
            $body = (new ResponseDeserializer())->serialize($requestObject);
        } else {
            $body = "";
        }
        $result = $this->client->post($path, [], $body);
        if ($returnClassName) {
            return $this->deserialize($result, $returnClassName);
        }
    }

    /**
     * @throws Exception
     */
    protected function delete(string $path): void
    {
        $this->client->delete($path);
    }


    /**
     * @throws Exception
     */
    protected function getRaw(string $path): ResponseInterface
    {
        return $this->client->get($path);
    }
}
