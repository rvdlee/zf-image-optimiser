<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Gifsicle extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'gifsicle';
}