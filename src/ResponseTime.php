<?php

declare(strict_types=1);

namespace LosMiddleware\ResponseTime;

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

    /** @var array{header_name: string} */
    private array $options;

    /** @param array{header_name: string} $options */
    public function __construct(array $options = [])
    {
        $this->options = [
            'header_name' => $options['header_name'] ?? self::HEADER_NAME,
        ];
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $server = $request->getServerParams();

        if (! array_key_exists('REQUEST_TIME_FLOAT', $server)) {
            $requestTime = microtime(true);
        } else {
            $requestTime = (float) $server['REQUEST_TIME_FLOAT'];
        }

        $response = $handler->handle($request);

        $time = (microtime(true) - $requestTime) * 1000;

        return $response->withHeader($this->options['header_name'], sprintf('%2.2fms', $time));
    }
}
