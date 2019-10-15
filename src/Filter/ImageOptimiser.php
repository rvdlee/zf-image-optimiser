<?php

namespace Rvdlee\ZfImageOptimiser\Filter;

use Exception;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;
use Zend\Filter\AbstractFilter;

class ImageOptimiser extends AbstractFilter
{
    /**
     * @var ImageOptimiserService
     */
    protected $imageOptimiserService;

    public function __construct(ImageOptimiserService $imageOptimiserService)
    {
        $this->setImageOptimiserService($imageOptimiserService);
    }

    public function filter($value)
    {
        try {
            $this->getImageOptimiserService()->optimize($value['tmp_name']);
        } catch (Exception $exception) {
            throw $exception;
        }

        return $value;
    }

    /**
     * @return ImageOptimiserService
     */
    public function getImageOptimiserService() : ImageOptimiserService
    {
        return $this->imageOptimiserService;
    }

    /**
     * @param ImageOptimiserService $imageOptimiserService
     *
     * @return ImageOptimiser
     */
    public function setImageOptimiserService(ImageOptimiserService $imageOptimiserService) : ImageOptimiser
    {
        $this->imageOptimiserService = $imageOptimiserService;

        return $this;
    }
}