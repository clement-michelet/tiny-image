<?php

namespace Toothless\TinyImage\Extractor;

/**
 * Class RGBColorExtractor
 */
class RGBColorExtractor implements ColorExtractorInterface
{
    /**
     * {@inheritdoc}
     */
    public function extract($content)
    {
        return substr(bin2hex($content), 0, 6);
    }
}
