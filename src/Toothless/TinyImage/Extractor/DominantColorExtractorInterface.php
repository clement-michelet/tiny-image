<?php

namespace Toothless\TinyImage\Extractor;

/**
 * Interface DominantColorExtractorInterface
 */
interface DominantColorExtractorInterface
{
    /**
     * Get the hexadecimal dominant color code for the given image content
     *
     * @param string $content
     *
     * @return string
     */
    public function extract($content);
}
