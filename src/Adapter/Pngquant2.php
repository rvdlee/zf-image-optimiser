<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Pngquant2 extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'pngquant';

    public function optimize(Image $image)
    {
        return sprintf('%s %s %s', $this->getBinaryPath(), implode(' ', $this->getBinaryOptions()), $image->getPath());
    }
}