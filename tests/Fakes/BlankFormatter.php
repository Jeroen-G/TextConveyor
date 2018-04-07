<?php

namespace JeroenG\TextConveyor\Tests\Fakes;

use Closure;
use JeroenG\TextConveyor\FormatterInterface;

class BlankFormatter implements FormatterInterface
{
    public function handle(string $content, Closure $next)
    {
        return $next($content);
    }
}
