<?php

namespace Toothless\TinyImage\Extractor;

use Imagick;

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
     * @var Imagick
     */
    private $imagick;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->imagick = new Imagick();
        $this->extractor = new ImagickDominantColorExtractor($this->imagick);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(DominantColorExtractorInterface::class, $this->extractor);
    }

    /**
     * @param string $filename
     * @param string $expectedColor
     *
     * @dataProvider provideExtract
     */
    public function testExtract($filename, $expectedColor)
    {
        $content = file_get_contents(__DIR__.'/../../../Fixtures/'.$filename);

        $color = $this->extractor->extract($content);
        $this->assertSame($expectedColor, $color);
    }

    /**
     * @return array
     */
    public function provideExtract()
    {
        return [
            ['file1.jpg', '5e5b5a'],
            ['file2.jpg', '896c51'],
            ['file3.png', '040404'],
        ];
    }
}
