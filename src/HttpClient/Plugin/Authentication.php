<?php

namespace IparapheurV5Client\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use IparapheurV5Client\Model\TokenResult;
use Psr\Http\Message\RequestInterface;

final class Authentication implements Plugin
{
    public function __construct(
        private readonly TokenResult $tokenResult,
    ) {
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $authorizationValue = sprintf('Bearer %s', $this->tokenResult->accessToken);
        $request = $request->withHeader(
            'Authorization',
            $authorizationValue
        );
        return $next($request);
    }
}
