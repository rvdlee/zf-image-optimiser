<?php

namespace Rvdlee\ZfImageOptimiser;

use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getConsoleUsage(Console $console)
    {
        return [
            // Describe available commands
            'image-optimiser [--image]' => 'Optimise the given image',

            // Describe expected parameters
            ['--image|-i', 'Provide the image you want to optimise'],
        ];
    }
}

