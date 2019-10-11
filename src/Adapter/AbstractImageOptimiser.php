<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Interfaces\ImageOptimiserInterface;

abstract class AbstractImageOptimiser implements ImageOptimiserInterface
{
    /**
     * @var array
     */
    protected $binaryOptions;

    /**
     * @var string
     */
    protected $binaryPath;

    /**
     * @return array
     */
    public function getBinaryOptions() : array
    {
        return $this->binaryOptions;
    }

    /**
     * @param array $binaryOptions
     *
     * @return AbstractImageOptimiser
     */
    public function setBinaryOptions(array $binaryOptions) : AbstractImageOptimiser
    {
        $this->binaryOptions = $binaryOptions;

        return $this;
    }

    /**
     * @return string
     */
    public function getBinaryPath() : string
    {
        return $this->binaryPath;
    }

    /**
     * @param string $binaryPath
     *
     * @return AbstractImageOptimiser
     */
    public function setBinaryPath(string $binaryPath) : AbstractImageOptimiser
    {
        $this->binaryPath = $binaryPath;

        return $this;
    }
}