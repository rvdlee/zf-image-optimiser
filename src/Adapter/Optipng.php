<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Optipng extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'optipng';
}