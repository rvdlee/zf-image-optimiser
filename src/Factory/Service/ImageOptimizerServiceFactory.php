<?php

namespace Rvdlee\ZfImageOptimizer\Factory\Service;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimizer\Exception\InvalidArgumentException;
use Rvdlee\ZfImageOptimizer\Exception\InvalidConfigurationException;
use Rvdlee\ZfImageOptimizer\Interfaces\ImageOptimizerInterface;
use Rvdlee\ZfImageOptimizer\Service\ImageOptimizerService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImageOptimizerServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return object|ImageOptimizerService
     * @throws InvalidConfigurationException
     * @throws InvalidArgumentException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array|ImageOptimizerInterface $adapters */
        $adapters = [];
        /** @var array $config */
        $config = $container->get('config');

        if ( ! isset($config['rvdlee']['zf-image-optimizer'])
            || ! key_exists(
                'enabled',
                $config['rvdlee']['zf-image-optimizer']
            )
        ) {
            throw new InvalidConfigurationException('We are missing configuration to make this code work.');
        }

        foreach($config['rvdlee']['zf-image-optimizer']['enabled'] as $adapter) {
            $adapter = $container->get($adapter);
        }

        return new ImageOptimizerService($adapters);
    }
}