<?php

namespace JeroenG\TextConveyor\Tests\Formatters;

use Closure;

class RemoveBadWords
{
    public static $badWords = [
        'shit',
    ];

    public function handle($content, Closure $next)
    {
        $content = str_replace(self::$badWords, '¯\_(ツ)_/¯', $content);

        return $next($content);
    }
}
