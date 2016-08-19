<?php

namespace Toothless\TinyImage\Converter;

use Toothless\TinyImage\Extractor\DominantColorExtractorInterface;
use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Class DominantColorConverter
 */
class DominantColorConverter implements ConverterInterface
{
    /**
     * @var DominantColorExtractorInterface
     */
    private $extractor;

    /**
     * DominantColorConverter constructor.
     *
     * @param DominantColorExtractorInterface $extractor
     */
    public function __construct(DominantColorExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * {@inheritdoc}
     */
    public function convert(ContentProviderInterface $provider)
    {
        $hexColor = $this->extractor->extract($provider->getContent());

        $gif = <<<GIF
47494638396101000100800100{$hexColor}0000002c00000000010001000002024401003b
GIF;

        return base64_encode(
            hex2bin($gif)
        );
    }
}
