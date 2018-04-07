<?php

namespace JeroenG\TextConveyor\Tests;

use JeroenG\TextConveyor\Assembler;
use JeroenG\TextConveyor\Formatters\CommonMark;

class CommonMarkFormatterTest extends TestCase
{
    public function test_commonmark_is_initiatable()
    {
        $assembler = $this->makeAssemblerWithFormatter();

        $this->assertEquals([CommonMark::class], $assembler->getFormatters());
    }

    public function test_markdown_is_formatted()
    {
        $assembler = $this->makeAssemblerWithFormatter();

        $line = $assembler->sendContentThroughFormatters('**Strong**');
        $this->assertEquals('<p><strong>Strong</strong></p>', trim($line));
    }

    public function test_unsafe_html_is_escaped_by_configuration()
    {
        $assembler = $this->makeAssemblerWithFormatter();

        $line = $assembler->sendContentThroughFormatters('<div onclick="alert(\'XSS\')">click me</div><script>alert("XSS")</script><script>alert("XSS");</script>');
        $this->assertEquals('&lt;div onclick="alert(\'XSS\')"&gt;click me&lt;/div&gt;&lt;script&gt;alert("XSS")&lt;/script&gt;&lt;script&gt;alert("XSS");&lt;/script&gt;', trim($line));
    }

    public function test_unsafe_links_are_escaped_by_configuration()
    {

        $assembler = $this->makeAssemblerWithFormatter();

        $line = $assembler->sendContentThroughFormatters('[Click me](javascript:alert(\'XSS\'))<javascript:alert("XSS")>![Inline image](data:image/gif;base64,R0lGODlhEAAQAMQAAORHHOVSKudfOulrSOp3WOyDZu6QdvCchPGolfO0o/XBs/fNwfjZ0frl3/zy7////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAkAABAALAAAAAAQABAAAAVVICSOZGlCQAosJ6mu7fiyZeKqNKToQGDsM8hBADgUXoGAiqhSvp5QAnQKGIgUhwFUYLCVDFCrKUE1lBavAViFIDlTImbKC5Gm2hB0SlBCBMQiB0UjIQA7)');
        $this->assertEquals('<p><a>Click me</a><a>javascript:alert(&quot;XSS&quot;)</a><img src="data:image/gif;base64,R0lGODlhEAAQAMQAAORHHOVSKudfOulrSOp3WOyDZu6QdvCchPGolfO0o/XBs/fNwfjZ0frl3/zy7////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAkAABAALAAAAAAQABAAAAVVICSOZGlCQAosJ6mu7fiyZeKqNKToQGDsM8hBADgUXoGAiqhSvp5QAnQKGIgUhwFUYLCVDFCrKUE1lBavAViFIDlTImbKC5Gm2hB0SlBCBMQiB0UjIQA7" alt="Inline image" /></p>', trim($line));
    }

    protected function makeAssemblerWithFormatter()
    {
        return (new Assembler)->addFormatter(CommonMark::class);
    }
}
