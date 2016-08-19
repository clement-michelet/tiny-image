<?php

namespace Toothless\TinyImage\Extractor;

use Imagick;

/**
 * Class ImagickDominantColorExtractor
 */
class ImagickDominantColorExtractor implements DominantColorExtractorInterface
{
    /**
     * Default width for image sampling
     *
     * @var int
     *
     * @see http://php.net/manual/en/imagick.resizeimage.php
     */
    const DEFAULT_SAMPLE_WIDTH = 256;

    /**
     * Default height for image sampling
     *
     * @var int
     *
     * @see http://php.net/manual/en/imagick.resizeimage.php
     */
    const DEFAULT_SAMPLE_HEIGHT = 256;

    /**
     * Default blur ratio for image sampling
     *
     * @var int
     *
     * @see http://php.net/manual/en/imagick.resizeimage.php
     */
    const DEFAULT_SAMPLE_BLUR_RATIO = 1;

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
     * @var int
     */
    private $sampleBlurRatio;

    /**
     * ImagickDominantColorExtractor constructor.
     *
     * @param Imagick $imagick         Imagick instance
     * @param int     $sampleWidth     Image sample width
     * @param int     $sampleHeight    Image sample height
     * @param int     $sampleBlurRatio Image blur ratio
     */
    public function __construct(
        Imagick $imagick,
        $sampleWidth = self::DEFAULT_SAMPLE_WIDTH,
        $sampleHeight = self::DEFAULT_SAMPLE_HEIGHT,
        $sampleBlurRatio = self::DEFAULT_SAMPLE_BLUR_RATIO
    ) {
        $this->imagick = $imagick;
        $this->sampleWidth = $sampleWidth;
        $this->sampleHeight = $sampleHeight;
        $this->sampleBlurRatio = $sampleBlurRatio;
    }


    /**
     * {@inheritdoc}
     */
    public function extract($content)
    {
        $this->imagick->readImageBlob($content);
        $this->imagick->resizeImage(
            $this->sampleWidth,
            $this->sampleHeight,
            Imagick::FILTER_GAUSSIAN,
            $this->sampleBlurRatio
        );
        $this->imagick->quantizeImage(1, Imagick::COLORSPACE_RGB, 0, false, false);
        $this->imagick->setFormat('RGB');

        return substr(bin2hex($this->imagick->getImageBlob()), 0, 6);
    }
}
