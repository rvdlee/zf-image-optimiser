<?php

namespace Rvdlee\ZfImageOptimizer\Model;

use Rvdlee\ZfImageOptimizer\Exception\InvalidArgumentException;
use SplFileInfo;

class Image
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var SplFileInfo
     */
    protected $splFileInfo;

    /**
     * Image constructor.
     *
     * @param string $path
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $path)
    {
        if ( ! file_exists($path)) {
            throw new InvalidArgumentException(sprintf('The provided file(%s) does not exist.', $path));
        }

        $this->setPath($path)
             ->setSplFileInfo($path);
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Image
     */
    public function setPath(string $path) : Image
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return SplFileInfo
     */
    public function getSplFileInfo() : SplFileInfo
    {
        return $this->splFileInfo;
    }

    /**
     * @param SplFileInfo $splFileInfo
     *
     * @return Image
     */
    public function setSplFileInfo(SplFileInfo $splFileInfo) : Image
    {
        $this->splFileInfo = $splFileInfo;

        return $this;
    }
}