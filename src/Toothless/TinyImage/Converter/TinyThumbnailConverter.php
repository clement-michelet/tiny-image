<?php

namespace Toothless\TinyImage\Converter;

use Toothless\TinyImage\Extractor\TinyThumbnailExtractor;
use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Class TinyThumbnailConverter
 */
class TinyThumbnailConverter implements ConverterInterface
{
    /**
     * @var TinyThumbnailExtractor
     */
    private $extractor;

    /**
     * TinyThumbnailConverter constructor.
     *
     * @param TinyThumbnailExtractor $extractor
     */
    public function __construct(TinyThumbnailExtractor $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * {@inheritdoc}
     */
    public function convert(ContentProviderInterface $provider)
    {
        return $this->extractor->extract($provider->getContent());
    }

}
