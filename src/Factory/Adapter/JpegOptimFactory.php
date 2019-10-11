<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Adapter;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Adapter\JpegOptim;

class JpegOptimFactory extends AbstractImageOptimiserFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $args */
        $args = parent::__invoke($container, $requestedName, $options);

        return new JpegOptim(...$args);
    }
}