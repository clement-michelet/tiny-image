<?php

namespace Toothless\TinyImage\Tests\Extractor;

use Imagick;
use PHPUnit_Framework_MockObject_MockObject;
use Toothless\TinyImage\Extractor\DominantColorExtractorInterface;
use Toothless\TinyImage\Extractor\ImagickDominantColorExtractor;
use Toothless\TinyImage\Extractor\RGBColorExtractor;

/**
 * Class ImagickDominantColorExtractorTest
 */
class ImagickDominantColorExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ImagickDominantColorExtractor
     */
    private $extractor;

    /**
     * @var RGBColorExtractor|PHPUnit_Framework_MockObject_MockObject
     */
    private $rgbExtractor;

    /**
     * @var Imagick|PHPUnit_Framework_MockObject_MockObject
     */
    private $imagick;

    private $sampleWidth = 100;

    private $sampleHeight = 100;

    private $sampleBlur = 0.5;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->rgbExtractor = $this->createMock(RGBColorExtractor::class);
        $this->imagick = $this->createMock(Imagick::class);

        $this->extractor = new ImagickDominantColorExtractor(
            $this->rgbExtractor,
            $this->imagick,
            $this->sampleWidth,
            $this->sampleHeight,
            $this->sampleBlur
        );
    }

    public function testInstance()
    {
        $this->assertInstanceOf(DominantColorExtractorInterface::class, $this->extractor);
    }

    public function testExtract()
    {
        $content = 'dummy_content';
        $blobContent = 'content_blob';
        $expectedColor = 'ffffff';

        $this->imagick->method('getImageBlob')->willReturn($blobContent);
        $this->rgbExtractor->method('extract')->with($blobContent)->willReturn($expectedColor);

        $this->imagick->expects($this->once())->method('readImageBlob')->with($content);
        $this->imagick->expects($this->once())->method('resizeImage')->with(
            $this->sampleWidth,
            $this->sampleHeight,
            Imagick::FILTER_GAUSSIAN,
            $this->sampleBlur
        );
        $this->imagick->expects($this->once())->method('quantizeImage')->with(
            1,
            Imagick::COLORSPACE_RGB,
            0,
            false,
            false
        );
        $this->imagick->expects($this->once())->method('setFormat')->with('RGB');

        $color = $this->extractor->extract($content);
        $this->assertSame($expectedColor, $color);
    }
}
