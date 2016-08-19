<?php

namespace Toothless\TinyImage\Provider;

/**
 * Interface ContentProviderInterface
 */
interface ContentProviderInterface
{
    /**
     * Provide the content of the image file
     *
     * @return string
     */
    public function getContent();
}
