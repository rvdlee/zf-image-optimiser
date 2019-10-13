<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Model\Image;

class Pngquant2 extends AbstractImageOptimiser
{
    /**
     * @var string
     */
    protected $binaryPath = 'pngquant';

    public function optimizeCommand(Image $image) : string
    {
        /** @var array $binaryOptions */
        $binaryOptions = $this->getBinaryOptions();
        $binaryOptions[] = sprintf('-o %s', $image->getPath());
        $this->setBinaryOptions($binaryOptions);

        return parent::optimizeCommand($image);
    }
}