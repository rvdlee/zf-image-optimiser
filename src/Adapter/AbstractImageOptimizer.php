<?php

namespace Rvdlee\ZfImageOptimizer\Adapter;

use Rvdlee\ZfImageOptimizer\Interfaces\ImageOptimizerInterface;

abstract class AbstractImageOptimizer implements ImageOptimizerInterface
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
     * @return AbstractImageOptimizer
     */
    public function setBinaryOptions(array $binaryOptions) : AbstractImageOptimizer
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
     * @return AbstractImageOptimizer
     */
    public function setBinaryPath(string $binaryPath) : AbstractImageOptimizer
    {
        $this->binaryPath = $binaryPath;

        return $this;
    }
}