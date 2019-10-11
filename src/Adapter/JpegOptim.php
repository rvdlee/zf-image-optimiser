<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class JpegOptim extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'jpegoptim';

    public function optimize(Image $image)
    {
        // TODO: Implement optimize() method.
    }
}