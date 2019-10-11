<?php

namespace Rvdlee\ZfImageOptimiser\Interfaces;

use Rvdlee\ZfImageOptimiser\Model\Image;

interface ImageOptimiserInterface
{
    /**
     * This will optimize the image
     *
     * @param Image $image
     *
     * @return mixed
     */
    public function optimize(Image $image);

    /**
     * This function will run the validation chain to verify
     * if the image is fit to optimise through adapter.
     *
     * @param string $imagePath
     *
     * @return bool
     */
    public function canHandle(string $imagePath) : bool;
}