<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Service;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Exception\InvalidArgumentException;
use Rvdlee\ZfImageOptimiser\Exception\InvalidConfigurationException;
use Rvdlee\ZfImageOptimiser\Interfaces\ImageOptimiserInterface;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImageOptimiserServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return object|ImageOptimiserService
     * @throws InvalidConfigurationException
     * @throws InvalidArgumentException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array|ImageOptimiserInterface $adapters */
        $adapters = [];
        /** @var array $config */
        $config = $container->get('config');

        if ( ! isset($config['rvdlee']['zf-image-optimiser'])
            || ! key_exists(
                'enabled',
                $config['rvdlee']['zf-image-optimiser']
            )
        ) {
            throw new InvalidConfigurationException('We are missing configuration to make this code work.');
        }

        foreach($config['rvdlee']['zf-image-optimiser']['enabled'] as $adapter) {
            $adapters[] = $container->get($adapter);
        }

        return new ImageOptimiserService($adapters);
    }
}