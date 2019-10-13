<?php

namespace Rvdlee\ZfImageOptimiser\Service;

use Exception;
use Rvdlee\ZfImageOptimiser\Exception\InvalidArgumentException;
use Rvdlee\ZfImageOptimiser\Interfaces\ImageOptimiserInterface;
use Rvdlee\ZfImageOptimiser\Model\Image;
use Zend\Log\LoggerInterface;

class ImageOptimiserService
{
    /**
     * @var array|ImageOptimiserInterface
     */
    protected $adapters;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param array|ImageOptimiserInterface $adapters
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $adapters, LoggerInterface $logger)
    {
        $this->setLogger($logger);
        $this->getLogger()->info('Constucting ImageOptimiserService');

        /** @var ImageOptimiserInterface $adapter */
        foreach ($adapters as $adapter) {
            if ( ! $adapter instanceof ImageOptimiserInterface) {
                throw new InvalidArgumentException(
                    sprintf('Adapter configured does not have the %s interface.', ImageOptimiserInterface::class)
                );
            }

            $this->getLogger()->debug(sprintf('Added %s to the ImageOptimiserService.', get_class($adapter)));
            $this->addAdapter($adapter);
        }
    }

    /**
     * @param string $imagePath
     *
     * @return mixed|void
     * @throws Exception
     */
    public function optimize(string $imagePath)
    {
        /** @var ImageOptimiserInterface $adapter */
        foreach ($this->getAdapters() as $adapter) {
            try {
                if ($adapter->canHandle($imagePath)) {
                    /** @var string $command */
                    $command = $adapter->optimizeCommand(new Image($imagePath));

                    $this->getLogger()->info(sprintf('Handling %s via %s', $imagePath, get_class($adapter)));
                    $output = shell_exec(sprintf('%s 2>&1', $command));
                    $this->getLogger()->info($output);
                }
            } catch (Exception $exception) {
                $this->getLogger()->err(
                    sprintf('Exception when handling %s to via %s', $imagePath, get_class($adapter))
                );
            }
        }
    }

    /**
     * @return array|ImageOptimiserInterface
     */
    public function getAdapters()
    {
        return $this->adapters;
    }

    public function addAdapter(ImageOptimiserInterface $adapter)
    {
        $this->adapters[] = $adapter;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger() : LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return ImageOptimiserService
     */
    public function setLogger(LoggerInterface $logger) : ImageOptimiserService
    {
        $this->logger = $logger;

        return $this;
    }
}