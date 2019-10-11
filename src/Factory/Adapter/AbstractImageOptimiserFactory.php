<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Validator\ValidatorChain;

abstract class AbstractImageOptimiserFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $config */
        $config = $container->get('config');

        $binaryOptions = [];
        if (isset($config['rvdlee']['zf-image-optimiser'][$requestedName]['binary-options'])) {
            $binaryOptions = $config['rvdlee']['zf-image-optimiser'][$requestedName]['binary-options'];
        }

        $validatorChain = [];
        if (isset($config['rvdlee']['zf-image-optimiser'][$requestedName]['validator-chain'])) {
            $validatorChainConfigs = $config['rvdlee']['zf-image-optimiser'][$requestedName]['validator-chain'];

            $validatorChain = new ValidatorChain();
            /** @var array $validatorChainConfig */
            foreach ($validatorChainConfigs as $validatorChainConfig) {
                if (class_exists($validatorChainConfig['name'])) {
                    $validatorConfig = isset($validatorChainConfig['options']) ? $validatorChainConfig['options'] : [];
                    $validator = new $validatorChainConfig['name']($validatorConfig);
                    $validatorChain->attach($validator);
                }
            }
        }

        return [
            $binaryOptions,
            $validatorChain
        ];
    }
}