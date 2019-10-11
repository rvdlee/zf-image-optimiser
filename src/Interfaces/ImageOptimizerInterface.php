<?php

namespace Rvdlee\ZfImageOptimizer\Interfaces;

interface ImageOptimizerInterface
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