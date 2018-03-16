<?php

namespace JeroenG\TextConveyor\Tests;

use JeroenG\TextConveyor\Assembler;
use JeroenG\TextConveyor\Tests\Fakes\BlankFormatter;
use JeroenG\TextConveyor\Tests\Fakes\RemoveBadWords;

class AssemblerTest extends TestCase
{
    public function test_bad_words_are_replaced()
    {
        $assembler = new Assembler;
        $line = $assembler->sendContentThroughFormatters('Oh shit');
        $this->assertEquals('Oh ¯\_(ツ)_/¯', $line);
    }

    public function test_formatters_can_be_set()
    {
        $customFormatters = [BlankFormatter::class];
        Assembler::setFormatters($customFormatters);
        $this->assertEquals([
            RemoveBadWords::class,
            BlankFormatter::class,
        ], Assembler::$formatters);
    }
}
