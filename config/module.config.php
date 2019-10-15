<?php

namespace Rvdlee\ZfImageOptimiser;

use Rvdlee\ZfImageOptimiser\Adapter\Gifsicle;
use Rvdlee\ZfImageOptimiser\Adapter\JpegOptim;
use Rvdlee\ZfImageOptimiser\Adapter\Optipng;
use Rvdlee\ZfImageOptimiser\Adapter\Pngquant2;
use Rvdlee\ZfImageOptimiser\Controller\ConsoleController;
use Rvdlee\ZfImageOptimiser\Factory\Adapter\GifsicleFactory;
use Rvdlee\ZfImageOptimiser\Factory\Adapter\JpegOptimFactory;
use Rvdlee\ZfImageOptimiser\Factory\Adapter\OptipngFactory;
use Rvdlee\ZfImageOptimiser\Factory\Adapter\Pngquant2Factory;
use Rvdlee\ZfImageOptimiser\Factory\Controller\ConsoleControllerFactory;
use Rvdlee\ZfImageOptimiser\Factory\Filter\ImageOptimiserFactory;
use Rvdlee\ZfImageOptimiser\Factory\Service\ImageOptimiserServiceFactory;
use Rvdlee\ZfImageOptimiser\Filter\ImageOptimiser;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;

return [
    'console'         => [
        'router' => [
            'routes' => [
                'console_image_optimiser' => [
                    'options' => [
                        'route'    => 'image-optimiser [--image=]',
                        'defaults' => [
                            'controller' => ConsoleController::class,
                            'action'     => 'optimiseImages',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers'     => [
        'factories' => [
            ConsoleController::class => ConsoleControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            ImageOptimiserService::class => ImageOptimiserServiceFactory::class,

            Gifsicle::class  => GifsicleFactory::class,
            JpegOptim::class => JpegOptimFactory::class,
            Optipng::class   => OptipngFactory::class,
            Pngquant2::class => Pngquant2Factory::class,
        ],
    ],
    'filters'   => [
        'factories' => [
            ImageOptimiser::class => ImageOptimiserFactory::class,
        ],
    ],
];