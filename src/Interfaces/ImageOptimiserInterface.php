<?php

namespace Rvdlee\ZfImageOptimiser\Interfaces;

interface ImageOptimiserInterface
{
    /**
     * This will optimize the image
     *
     * @param string $imagePath
     *
     * @return mixed
     */
    public function optimize(string $imagePath);
}