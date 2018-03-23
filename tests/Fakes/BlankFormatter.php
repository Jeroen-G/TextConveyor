<?php

namespace JeroenG\TextConveyor\Tests\Fakes;

use Closure;

class BlankFormatter
{
    public function handle($content, Closure $next)
    {
        return $next($content);
    }
}
