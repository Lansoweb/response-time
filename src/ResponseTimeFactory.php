<?php

namespace LosMiddleware\ResponseTime;

use Interop\Container\ContainerInterface;

class ResponseTimeFactory
{
    /**
     * Creates the middleware
     *
     * @param ContainerInterface $container
     * @return \LosMiddleware\ResponseTime\ResponseTime
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $options = array_key_exists('los_response_time', $config) && !empty($config['los_response_time'])
            ? $config['los_response_time']
            : [];

        return new ResponseTime($options);
    }
}
