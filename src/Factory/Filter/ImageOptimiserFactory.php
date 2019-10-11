<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Filter;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Filter\ImageOptimiser;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImageOptimiserFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ImageOptimiserService $imageOptimiserService */
        $imageOptimiserService = $container->get(ImageOptimiserService::class);
        return new ImageOptimiser($imageOptimiserService);
    }
}