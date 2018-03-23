<?php

namespace JeroenG\TextConveyor\Tests;

use JeroenG\TextConveyor\Assembler;
use JeroenG\TextConveyor\Tests\Fakes\BlankFormatter;
use JeroenG\TextConveyor\Tests\Fakes\RemoveBadWords;

class AssemblerTest extends TestCase
{
    public function test_formatters_can_be_set()
    {
        $assembler = new Assembler;
        $assembler->setFormatters([BlankFormatter::class, RemoveBadWords::class]);

        $this->assertEquals([BlankFormatter::class, RemoveBadWords::class], $assembler->getFormatters());
    }

    public function test_a_single_formatter_can_be_added()
    {
        $assembler = new Assembler;
        $assembler->addFormatter(BlankFormatter::class);

        $this->assertEquals([BlankFormatter::class], $assembler->getFormatters());
    }

    public function test_a_formatter_can_be_added_only_once()
    {
        $assembler = new Assembler;
        $assembler->addFormatter(BlankFormatter::class)->addFormatter(BlankFormatter::class);

        $this->assertEquals([BlankFormatter::class], $assembler->getFormatters());
    }

    public function test_a_single_formatter_can_be_removed()
    {
        $assembler = new Assembler;
        $assembler->setFormatters([BlankFormatter::class, RemoveBadWords::class]);

        $this->assertEquals([BlankFormatter::class, RemoveBadWords::class], $assembler->getFormatters());

        $assembler->removeFormatter(BlankFormatter::class);

        $this->assertContains(RemoveBadWords::class, $assembler->getFormatters());
    }

    public function test_bad_words_are_replaced()
    {
        $assembler = new Assembler;
        $assembler->addFormatter(function ($content) {
            return 'Oh ¯\_(ツ)_/¯';
        });

        $line = $assembler->sendContentThroughFormatters('Oh shit');
        $this->assertEquals('Oh ¯\_(ツ)_/¯', $line);
    }
}
