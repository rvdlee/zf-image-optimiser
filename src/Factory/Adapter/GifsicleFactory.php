<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Adapter;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Adapter\Gifsicle;

class GifsicleFactory extends AbstractImageOptimiserFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $args */
        $args = parent::__invoke($container, $requestedName, $options);

        return new Gifsicle(...$args);
    }
}