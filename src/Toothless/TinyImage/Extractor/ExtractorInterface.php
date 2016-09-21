<?php

namespace Toothless\TinyImage\Extractor;

/**
 * Interface ExtractorInterface
 */
interface ExtractorInterface
{
    /**
     * Extract a string from the given image content
     *
     * @param string $content
     *
     * @return string
     */
    public function extract($content);
}
