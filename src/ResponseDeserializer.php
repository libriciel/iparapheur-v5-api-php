<?php

namespace IparapheurV5Client;

use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseDeserializer
{
    /**
     * @throws IparapheurV5Exception
     */
    public function deserialize(ResponseInterface $response, string $className): mixed
    {
        if (
            ! $response->hasHeader('Content-Type') ||
            $response->getHeaderLine('Content-Type') !== 'application/json'
        ) {
            throw new IparapheurV5Exception("Response is not in json");
        }
        $extractor = new PropertyInfoExtractor([], [
            new PhpDocExtractor(),
            new ReflectionExtractor()
        ]);
        $normalizers = [
            new ArrayDenormalizer(),
            new DateTimeNormalizer(),
            new BackedEnumNormalizer(),
            new ObjectNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter(),
                null,
                $extractor
            ),
        ];

        return (new Serializer($normalizers, [new JsonEncoder()]))
            ->deserialize($response->getBody(), $className, 'json');
    }
}
