<?php

namespace JeroenG\TextConveyor\Facades;

use JeroenG\TextConveyor\Assembler;
use Illuminate\Support\Facades\Facade;

class TextConveyor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Assembler::class;
    }
}
