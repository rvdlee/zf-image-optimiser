<?php

namespace Rvdlee\ZfImageOptimiser\Controller;

use Exception;
use Rvdlee\ZfImageOptimiser\Service\ImageOptimiserService;
use Zend\Mvc\Controller\AbstractActionController;

class ConsoleController extends AbstractActionController
{
    /**
     * @var ImageOptimiserService
     */
    protected $imageOptimiserService;

    public function __construct(ImageOptimiserService $imageOptimiserService)
    {
        $this->setImageOptimiserService($imageOptimiserService);
    }

    /**
     * Console wrapper for service
     *
     * @throws Exception
     */
    public function optimiseImagesAction()
    {
        /** @var string $fromYear */
        $image = $this->params()->fromRoute('image');
        if ($image === null) {
            die('You need the --image param.');
        }

        try {
            $this->getImageOptimiserService()->optimize($image);
        } catch (Exception $exception) {
            throw $exception;
        }
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
     * @return ConsoleController
     */
    public function setImageOptimiserService(ImageOptimiserService $imageOptimiserService) : ConsoleController
    {
        $this->imageOptimiserService = $imageOptimiserService;

        return $this;
    }
}