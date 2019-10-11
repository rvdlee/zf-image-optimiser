<?php

namespace Rvdlee\ZfImageOptimiser\Service;

use Exception;
use Rvdlee\ZfImageOptimiser\Exception\InvalidArgumentException;
use Rvdlee\ZfImageOptimiser\Interfaces\ImageOptimiserInterface;
use Rvdlee\ZfImageOptimiser\Model\Image;

class ImageOptimiserService
{
    /**
     * @var array|ImageOptimiserInterface
     */
    protected $adapters;

    /**
     * @param array|ImageOptimiserInterface $adapters
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $adapters)
    {
        /** @var ImageOptimiserInterface $adapter */
        foreach ($adapters as $adapter) {
            if ( ! $adapter instanceof ImageOptimiserInterface) {
                throw new InvalidArgumentException(
                    sprintf('Adapter configured does not have the %s interface.', ImageOptimiserInterface::class)
                );
            }

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
                    $command = $adapter->optimize(new Image($imagePath));

                    $output = shell_exec($command);
                }
            } catch (Exception $exception) {
                throw $exception;
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
}