<?php

namespace JeroenG\TextConveyor;

use Closure;

interface FormatterInterface
{
    public function handle(string $content, Closure $next);
}