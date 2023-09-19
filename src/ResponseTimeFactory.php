<?php

declare(strict_types=1);

namespace Los\ResponseTime;

use Psr\Container\ContainerInterface;

class ResponseTimeFactory
{
    public function __invoke(ContainerInterface $container): ResponseTime
    {
        $config  = $container->get('config');
        $options = $config['los_response_time'] ?? [];

        return new ResponseTime($options);
    }
}
