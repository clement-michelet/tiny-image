<?php

namespace Toothless\TinyImage\Converter;

/**
 * Class ConverterManager
 */
class ConverterManager
{
    /**
     * @var array
     */
    private $converters = [];

    /**
     * Get registered converters
     *
     * @return ConverterInterface[]
     */
    public function getConverters()
    {
        return $this->converters;
    }

    /**
     * Register a converter
     *
     * @param string             $name
     * @param ConverterInterface $converter
     */
    public function addConverter($name, ConverterInterface $converter)
    {
        $this->converters[$name] = $converter;
    }

    /**
     * Get the converter
     *
     * @param string $name
     *
     * @return ConverterInterface
     */
    public function getConverter($name)
    {
        if (isset($this->converters[$name])) {
            return $this->converters[$name];
        }

        throw new \OutOfBoundsException(sprintf('Converter "%s" not found.', $name));
    }
}
