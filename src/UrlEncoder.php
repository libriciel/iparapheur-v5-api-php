<?php

namespace IparapheurV5Client;

use IparapheurV5Client\Exception\IparapheurV5Exception;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class UrlEncoder implements EncoderInterface
{
    public function encode(mixed $data, string $format, array $context = []): string
    {
        $str = "";

        if (! is_iterable($data)) {
            throw new IparapheurV5Exception("Unable to create url from data");
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                //TODO
                continue;
            }
            $str .= rawurlencode($key) . "=" . rawurlencode($value) . "&";
        }

        return rtrim($str, "&");
    }

    public function supportsEncoding(string $format): bool
    {
        return $format === 'url';
    }
}
