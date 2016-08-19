<?php

namespace Toothless\TinyImage\Provider;

/**
 * Class ContentProvider
 */
class ContentProvider implements ContentProviderInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * ContentProvider constructor.
     *
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }
}
