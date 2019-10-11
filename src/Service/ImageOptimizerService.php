<?php

namespace Rvdlee\ZfImageOptimizer\Service;

use Exception;
use Rvdlee\ZfImageOptimizer\Exception\InvalidArgumentException;
use Rvdlee\ZfImageOptimizer\Interfaces\ImageOptimizerInterface;

class ImageOptimizerService implements ImageOptimizerInterface
{
    /**
     * @var array|ImageOptimizerInterface
     */
    protected $adapters;

    /**
     * @param array|ImageOptimizerInterface $adapters
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $adapters)
    {
        /** @var ImageOptimizerInterface $adapter */
        foreach ($adapters as $adapter) {
            if ( ! $adapter instanceof ImageOptimizerInterface) {
                throw new InvalidArgumentException(
                    sprintf('Adapter configured does not have the %s interface.', ImageOptimizerInterface::class)
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
        /** @var ImageOptimizerInterface $adapter */
        foreach ($this->getAdapters() as $adapter) {
            try {
                $adapter->optimize($imagePath);
            } catch (Exception $exception) {
                throw $exception;
            }
        }
    }

    /**
     * @return array|ImageOptimizerInterface
     */
    public function getAdapters()
    {
        return $this->adapters;
    }

    public function addAdapter(ImageOptimizerInterface $adapter)
    {
        $this->adapters[] = $adapter;
    }
}