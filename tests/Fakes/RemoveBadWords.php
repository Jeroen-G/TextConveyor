<?php

namespace JeroenG\TextConveyor\Tests\Fakes;

use Closure;
use JeroenG\TextConveyor\FormatterInterface;

class RemoveBadWords implements FormatterInterface
{
    public static $badWords = [
        'shit',
    ];

    public function handle(string $content, Closure $next)
    {
        $content = str_replace(self::$badWords, '¯\_(ツ)_/¯', $content);

        return $next($content);
    }
}
