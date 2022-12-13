<?php

declare(strict_types=1);

namespace IparapheurV5Client\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ExceptionThrower implements Plugin
{
    /**
     * @throws IparapheurV5Exception
     * @throws \JsonException
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            $statusCode = $response->getStatusCode();

            if ($statusCode < 400) {
                return $response;
            }

            $body = (string)$response->getBody();
            if (
                $response->hasHeader('Content-Type') &&
                $response->getHeaderLine('Content-Type') === 'application/json'
            ) {
                $message['body'] = \json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            } else {
                $message['body'] = $body;
            }

            throw new IparapheurV5Exception(\json_encode($message, JSON_THROW_ON_ERROR), $statusCode);
        });
    }
}
