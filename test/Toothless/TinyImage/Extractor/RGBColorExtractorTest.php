<?php

namespace Toothless\TinyImage\Extractor;

/**
 * Class RGBColorExtractorTest
 */
class RGBColorExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RGBColorExtractor
     */
    private $extractor;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->extractor = new RGBColorExtractor();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ColorExtractorInterface::class, $this->extractor);
    }

    /**
     * @param string $expectedColor
     *
     * @dataProvider provideExtract
     */
    public function testExtract($expectedColor)
    {
        $content = file_get_contents(__DIR__ . '/../../../Fixtures/TinyImage/Extractor/RGBColorExtractor/' . $expectedColor);
        $this->assertSame($expectedColor, $this->extractor->extract($content));
    }

    /**
     * @return array
     */
    public function provideExtract()
    {
        return [
            ['ffffff'],
            ['789abc'],
            ['123456'],
            ['ffffff'],
        ];
    }
}
