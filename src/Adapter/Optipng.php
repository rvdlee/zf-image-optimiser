<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Optipng extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'optipng';

    public function optimize(Image $image)
    {
        return sprintf('%s %s %s', $this->getBinaryPath(), implode(' ', $this->getBinaryOptions()), $image->getPath());
    }
}