<?php

namespace JeroenG\TextConveyor\Formatters;

use Closure;
use League\CommonMark\CommonMarkConverter;
use JeroenG\TextConveyor\FormatterInterface;

class CommonMark implements FormatterInterface
{
    public function handle(string $content, Closure $next)
    {
        $content = (new CommonMarkConverter([
                 'html_input' => 'escape',
                 'allow_unsafe_links' => false,
                 ]))
                 ->convertToHtml($content);

        return $next($content);
    }
}
