<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Adapter;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Adapter\Pngquant2;

class Pngquant2Factory extends AbstractImageOptimiserFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $args */
        $args = parent::__invoke($container, $requestedName, $options);

        return new Pngquant2(...$args);
    }
}