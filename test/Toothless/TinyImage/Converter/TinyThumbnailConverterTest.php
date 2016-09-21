<?php

namespace Toothless\TinyImage\Tests\Converter;

use PHPUnit_Framework_MockObject_MockObject;
use Toothless\TinyImage\Converter\ConverterInterface;
use Toothless\TinyImage\Converter\TinyThumbnailConverter;
use Toothless\TinyImage\Extractor\TinyThumbnailExtractor;
use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Class TinyThumbnailConverterTest
 */
class TinyThumbnailConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TinyThumbnailConverter
     */
    private $converter;

    /**
     * @var TinyThumbnailExtractor|PHPUnit_Framework_MockObject_MockObject
     */
    private $extractor;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->extractor = $this->createMock(TinyThumbnailExtractor::class);
        $this->converter = new TinyThumbnailConverter($this->extractor);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConverterInterface::class, $this->converter);
    }

    public function testConvert()
    {
        $content = 'content_foo';
        $provider = $this->createMock(ContentProviderInterface::class);
        $provider->method('getContent')->willReturn($content);

        $extractedContent = 'extracted_foo';
        $this->extractor->method('extract')->with($content)->willReturn($extractedContent);

        $convertedContent = $this->converter->convert($provider);

        $this->assertInternalType('string', $convertedContent);
        $this->assertSame($extractedContent, $convertedContent);
    }

}
