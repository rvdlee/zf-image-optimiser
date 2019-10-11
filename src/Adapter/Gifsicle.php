<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Gifsicle extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'gifsicle';

    public function optimize(Image $image)
    {
        // TODO: Implement optimize() method.
    }
}