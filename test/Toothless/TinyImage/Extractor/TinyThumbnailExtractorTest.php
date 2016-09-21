<?php

namespace Toothless\TinyImage\Extractor;

use Imagick;

/**
 * Class TinyThumbnailExtractorTest
 */
class TinyThumbnailExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TinyThumbnailExtractor
     */
    private $extractor;

    /**
     * @var Imagick|\PHPUnit_Framework_MockObject_MockObject
     */
    private $imagick;

    /**
     * @var int
     */
    private $sampleWidth = 5;

    /**
     * @var int
     */
    private $sampleHeight = 5;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->imagick = $this->createMock(Imagick::class);
        $this->extractor = new TinyThumbnailExtractor($this->imagick);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ExtractorInterface::class, $this->extractor);
    }


    public function testExtract()
    {
        $content = 'foo';
        $expectedContent = 'gif_foo';

        $this->imagick->method('getImageBlob')->willReturn($expectedContent);

        $this->imagick->expects($this->once())->method('readImageBlob')->with($content);
        $this->imagick->expects($this->once())->method('stripImage');
        $this->imagick->expects($this->once())
            ->method('resizeImage')
            ->with(
                $this->sampleWidth,
                $this->sampleHeight,
                Imagick::FILTER_QUADRATIC,
                1
            );
        $this->imagick->expects($this->once())->method('setFormat')->with('GIF');

        $extractedContent = $this->extractor->extract($content);
        $this->assertSame($expectedContent, $extractedContent);
    }
}
