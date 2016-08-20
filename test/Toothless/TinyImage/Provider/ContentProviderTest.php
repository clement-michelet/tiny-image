<?php

namespace Toothless\TinyImage\Tests\Provider;

use Toothless\TinyImage\Provider\ContentProvider;
use Toothless\TinyImage\Provider\ContentProviderInterface;

/**
 * Class ContentProviderTest
 */
class ContentProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $provider = new ContentProvider('dummy_content');
        $this->assertInstanceOf(ContentProviderInterface::class, $provider);
    }

    public function testGetContent()
    {
        $originalContent = 'content_foo';
        $provider = new ContentProvider($originalContent);

        $content = $provider->getContent();
        $this->assertInternalType('string', $content);
        $this->assertSame($originalContent, $content);
    }
}
