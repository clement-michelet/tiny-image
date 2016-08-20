<?php

namespace Toothless\TinyImage\Tests\Converter;

use PHPUnit_Framework_MockObject_MockObject;
use Toothless\TinyImage\Converter\ConverterInterface;
use Toothless\TinyImage\Converter\DominantColorConverter;
use Toothless\TinyImage\Extractor\DominantColorExtractorInterface;
use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Class DominantColorConverterTest
 */
class DominantColorConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DominantColorConverter
     */
    private $converter;

    /**
     * @var DominantColorExtractorInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $extractor;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->extractor = $this->createMock(DominantColorExtractorInterface::class);
        $this->converter = new DominantColorConverter($this->extractor);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConverterInterface::class, $this->converter);
    }

    /**
     * @param string $hexColor
     * @param string $expectedContent
     *
     * @dataProvider provideConvert
     */
    public function testConvert($hexColor, $expectedContent)
    {
        $this->extractor->method('extract')->willReturn($hexColor);
        $provider = $this->createMock(ContentProviderInterface::class);

        $content = $this->converter->convert($provider);

        $this->assertInternalType('string', $content);
        $this->assertSame($expectedContent, $content);
    }

    /**
     * @return array
     */
    public function provideConvert()
    {
        return [
            ['dac7b9', 'R0lGODlhAQABAIABANrHuQAAACwAAAAAAQABAAACAkQBADs='],
            ['17c3f2', 'R0lGODlhAQABAIABABfD8gAAACwAAAAAAQABAAACAkQBADs='],
            ['bf3335', 'R0lGODlhAQABAIABAL8zNQAAACwAAAAAAQABAAACAkQBADs='],
            ['7c50a0', 'R0lGODlhAQABAIABAHxQoAAAACwAAAAAAQABAAACAkQBADs='],
        ];
    }
}
