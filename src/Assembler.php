<?php

namespace JeroenG\TextConveyor;

use Illuminate\Pipeline\Pipeline;

class Assembler
{
    protected static $formatters = [];

    /**
     * This function runs the content through all registered formatters.
     *
     * @param string $content
     * @return mixed
     */
    public function sendContentThroughFormatters($content) : mixed
    {
        return app(Pipeline::class)
            ->send($content)
            ->through(self::$formatters)
            ->then(function ($content) {
                return $content;
            });
    }

    /**
     * Register formatters to the pipeline.
     *
     * @param array $formatters
     * @return self
     */
    public function setFormatters(array $formatters) : self
    {
        self::$formatters = array_unique(array_merge(self::$formatters, $formatters));
        return new self;
    }

    public function addFormatter(string $className) : self
    {
        self::$formatters = array_unique(array_merge(self::$formatters, $formatters));
        return new self;
    }

    /**
     * Sometimes you want to see which formatters are waiting alongside the conveyor.
     *
     * @return array
     */
    public function getFormatters() : array
    {
        return self::$formatters;
    }
}
