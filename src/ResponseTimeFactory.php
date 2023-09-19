<?php

declare(strict_types=1);

namespace Los\ResponseTime;

use Psr\Container\ContainerInterface;

use function assert;
use function is_array;
use function is_string;

class ResponseTimeFactory
{
    public function __invoke(ContainerInterface $container): ResponseTime
    {
        $config = $container->get('config');
        assert(is_array($config));
        $headerName = $config['los']['response_time']['header_name'] ?? $config['los_response_time']['header_name'] ?? ResponseTime::HEADER_NAME;
        assert(is_string($headerName));

        return new ResponseTime(new Options($headerName));
    }
}
