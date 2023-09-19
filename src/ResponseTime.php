<?php

declare(strict_types=1);

namespace Los\ResponseTime;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_key_exists;
use function microtime;
use function sprintf;

final class ResponseTime implements MiddlewareInterface
{
    public const HEADER_NAME = 'X-Response-Time';

    public function __construct(private readonly Options $options)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $server = $request->getServerParams();

        if (! array_key_exists('REQUEST_TIME_FLOAT', $server)) {
            $server['REQUEST_TIME_FLOAT'] = microtime(true);
        }

        $response = $handler->handle($request);

        $time = (microtime(true) - $server['REQUEST_TIME_FLOAT']) * 1000;

        return $response->withHeader($this->options->headerName(), sprintf('%2.2fms', $time));
    }
}
