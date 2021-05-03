<?php

declare(strict_types=1);

namespace LosMiddleware\ResponseTime;

use Psr\Container\ContainerInterface;

use function assert;
use function is_array;

class ResponseTimeFactory
{
    public function __invoke(ContainerInterface $container): ResponseTime
    {
        $config = $container->get('config');
        assert(is_array($config));
        $options = $config['los']['response_time'] ?? $config['los_response_time'] ?? [];
        assert(is_array($options));

        return new ResponseTime(['header_name' => (string) ($options['header_name'] ?? ResponseTime::HEADER_NAME)]);
    }
}
