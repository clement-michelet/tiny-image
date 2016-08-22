<?php

namespace Toothless\TinyImage\Extractor;

/**
 * Interface ColorExtractorInterface
 */
interface ColorExtractorInterface
{
    /**
     * Get the hexadecimal color code for the given image content
     *
     * @param string $content
     *
     * @return string
     */
    public function extract($content);
}
