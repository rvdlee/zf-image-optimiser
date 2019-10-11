<?php

namespace Rvdlee\ZfImageOptimiser;

use Rvdlee\ZfImageOptimiser\Factory\Service\ImageOptimiserServiceFactory;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;

return [
    'service_manager'    => [
        'factories' => [
            ImageOptimiserService::class => ImageOptimiserServiceFactory::class
        ],
    ],
];