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
     * @var RGBColorExtractor
     */
    private $extractor;

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
     * @param RGBColorExtractor $extractor
     * @param Imagick           $imagick Imagick instance
     * @param int               $sampleWidth Image sample width
     * @param int               $sampleHeight Image sample height
     * @param int               $sampleBlurRatio Image blur ratio
     */
    public function __construct(
        RGBColorExtractor $extractor,
        Imagick $imagick,
        $sampleWidth = self::DEFAULT_SAMPLE_WIDTH,
        $sampleHeight = self::DEFAULT_SAMPLE_HEIGHT,
        $sampleBlurRatio = self::DEFAULT_SAMPLE_BLUR_RATIO
    )
    {
        $this->extractor = $extractor;
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

        // Delegate color extraction
        return $this->extractor->extract($this->imagick->getImageBlob());
    }
}
