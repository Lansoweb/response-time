<?php
namespace LosMiddleware\ResponseTime;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ResponseTime implements MiddlewareInterface
{

    const HEADER_NAME = 'X-Response-Time';

    /**
     *
     * @var array
     */
    private $options;

    /**
     * ResponseTime constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = array_merge([
            'header_name' => self::HEADER_NAME
        ], $options);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $server = $request->getServerParams();

        if (! array_key_exists('REQUEST_TIME_FLOAT', $server)) {
            $server['REQUEST_TIME_FLOAT'] = microtime(true);
        }

        $response = $handler->handle($request);

        $time = (microtime(true) - $server['REQUEST_TIME_FLOAT']) * 1000;

        return $response->withHeader(self::HEADER_NAME, sprintf('%2.2fms', $time));
    }
}
