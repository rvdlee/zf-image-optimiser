<?php

namespace Rvdlee\ZfImageOptimiser\Adapter;

use Rvdlee\ZfImageOptimiser\Interfaces\ImageOptimiserInterface;
use Zend\Validator\ValidatorChain;

abstract class AbstractImageOptimiser implements ImageOptimiserInterface
{
    /**
     * @var array
     */
    protected $binaryOptions;

    /**
     * @var string
     */
    protected $binaryPath;

    /**
     * @var ValidatorChain
     */
    protected $validatorChain;

    /**
     * AbstractImageOptimiser constructor.
     *
     * @param array          $binaryOptions
     * @param ValidatorChain $validatorChain
     */
    public function __construct(array $binaryOptions, ValidatorChain $validatorChain)
    {
        $this->setBinaryOptions($binaryOptions)
            ->setValidatorChain($validatorChain);
    }

    /**
     * In the Abstract class we just run the validator stack
     * that has been configured, you can override ofcourse.
     *
     * @param string $imagePath
     *
     * @return bool
     */
    public function canHandle(string $imagePath) : bool
    {
        return $this->getValidatorChain()->isValid($imagePath);
    }

    /**
     * @return array
     */
    public function getBinaryOptions() : array
    {
        return $this->binaryOptions;
    }

    /**
     * @param array $binaryOptions
     *
     * @return AbstractImageOptimiser
     */
    public function setBinaryOptions(array $binaryOptions) : AbstractImageOptimiser
    {
        $this->binaryOptions = $binaryOptions;

        return $this;
    }

    /**
     * @return string
     */
    public function getBinaryPath() : string
    {
        return $this->binaryPath;
    }

    /**
     * @param string $binaryPath
     *
     * @return AbstractImageOptimiser
     */
    public function setBinaryPath(string $binaryPath) : AbstractImageOptimiser
    {
        $this->binaryPath = $binaryPath;

        return $this;
    }

    /**
     * @return ValidatorChain
     */
    public function getValidatorChain() : ValidatorChain
    {
        return $this->validatorChain;
    }

    /**
     * @param ValidatorChain $validatorChain
     *
     * @return AbstractImageOptimiser
     */
    public function setValidatorChain(ValidatorChain $validatorChain) : AbstractImageOptimiser
    {
        $this->validatorChain = $validatorChain;

        return $this;
    }
}