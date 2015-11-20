<?php
namespace LosMiddleware\ResponseTime;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ResponseTime
{

    const HEADER_NAME = 'X-Response-Time';

    /**
     *
     * @var array
     */
    private $options;

    public function __construct($options = [])
    {
        $this->options = array_merge([
            'header_name' => self::HEADER_NAME
        ], $options);
    }

    /**
     * Runs the middleware
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $server = $request->getServerParams();

        if (! array_key_exists('REQUEST_TIME_FLOAT', $server)) {
            $server['REQUEST_TIME_FLOAT'] = microtime(true);
        }

        $response = $next($request, $response);

        $time = (microtime(true) - $server['REQUEST_TIME_FLOAT']) * 1000;

        return $response->withHeader(self::HEADER_NAME, sprintf('%2.2fms', $time));
    }
}
