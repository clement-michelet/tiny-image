<?php

namespace Toothless\TinyImage\Converter;

use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Interface ConverterInterface
 */
interface ConverterInterface
{
    /**
     * Return the content in base64
     *
     * @param ContentProviderInterface $provider
     *
     * @return string
     */
    public function convert(ContentProviderInterface $provider);
}
