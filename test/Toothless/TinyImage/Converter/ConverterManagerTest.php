<?php

namespace Toothless\TinyImage\Tests\Converter;

use Toothless\TinyImage\Converter\ConverterInterface;
use Toothless\TinyImage\Converter\ConverterManager;

/**
 * Class ConverterManagerTest
 */
class ConverterManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConverterManager
     */
    private $manager;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->manager = new ConverterManager();
    }

    public function testGetConvertersShouldReturnAnArray()
    {
        $this->assertInternalType('array', $this->manager->getConverters());
    }

    public function testAddConverterShouldStoreConverters()
    {
        $converter = $this->createMock(ConverterInterface::class);

        $this->manager->addConverter('foo', $converter);
        $this->assertCount(1, $this->manager->getConverters());

        $this->manager->addConverter('bar', $converter);
        $this->assertCount(2, $this->manager->getConverters());

        $this->manager->addConverter('baz', $converter);
        $this->assertCount(3, $this->manager->getConverters());
    }

    public function testGetConverterWithInvalidNameShouldThrowAnOutOfBoundException()
    {
        $this->expectException('OutOfBoundsException');

        $this->manager->getConverter('foo');
    }

    public function testGetConverterShouldReturnTheRequestedConverter()
    {
        // Given
        $converterA = $this->createMock(ConverterInterface::class);
        $this->manager->addConverter('foo', $converterA);

        $converterB = $this->createMock(ConverterInterface::class);
        $this->manager->addConverter('bar', $converterB);

        // When
        $converter = $this->manager->getConverter('bar');

        // Then
        $this->assertSame($converterB, $converter);
    }
}
