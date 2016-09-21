<?php

namespace Toothless\TinyImage\Extractor;

use Imagick;

/**
 * Class TinyThumbnailExtractor
 */
class TinyThumbnailExtractor implements ExtractorInterface
{
    /**
     * @var Imagick
     */
    private $imagick;

    /**
     * @var int
     */
    private $sampleWidth;

    /**
     * @var int
     */
    private $sampleHeight;

    /**
     * TinyThumbnailExtractor constructor.
     *
     * @param Imagick $imagick
     * @param int     $sampleWidth
     * @param int     $sampleHeight
     */
    public function __construct(Imagick $imagick, $sampleWidth = 5, $sampleHeight = 5)
    {
        $this->imagick = $imagick;
        $this->sampleWidth = $sampleWidth;
        $this->sampleHeight = $sampleHeight;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($content)
    {
        $this->imagick->readImageBlob($content);
        $this->imagick->stripImage();
        $this->imagick->resizeImage($this->sampleWidth, $this->sampleHeight, Imagick::FILTER_QUADRATIC, 1);
        $this->imagick->setFormat('GIF');

        return $this->imagick->getImageBlob();
    }
}
