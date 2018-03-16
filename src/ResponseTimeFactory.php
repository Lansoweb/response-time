<?php

namespace LosMiddleware\ResponseTime;

use Psr\Container\ContainerInterface;

class ResponseTimeFactory
{
    /**
     * Creates the middleware
     *
     * @param ContainerInterface $container
     * @return \LosMiddleware\ResponseTime\ResponseTime
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $options = $config['los_response_time'] ?? [];

        return new ResponseTime($options);
    }
}
