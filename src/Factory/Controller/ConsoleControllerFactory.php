<?php

namespace Rvdlee\ZfImageOptimiser\Factory\Controller;

use Interop\Container\ContainerInterface;
use Rvdlee\ZfImageOptimiser\Controller\ConsoleController;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\Factory\FactoryInterface;

class ConsoleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Logger $logger */
        $logger = $container->get(Logger::class);
        /** @var Stream $writer */
        $logger->addWriter(new Stream('php://output'));
        /** @var ImageOptimiserService $imageOptimiserService */
        $imageOptimiserService = $container->build(ImageOptimiserService::class, ['logger' => $logger]);

        return new ConsoleController($imageOptimiserService);
    }
}