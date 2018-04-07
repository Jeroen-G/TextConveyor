<?php

namespace JeroenG\TextConveyor;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Container\Container;

class Assembler
{
    /**
     * @var array
     */
    protected $formatters = [];

    /**
     * This function runs the content through all registered formatters.
     *
     * @param string $content
     * @return string
     */
    public function sendContentThroughFormatters(string $content) : string
    {
        return (new Pipeline($this->getContainer()))
            ->send($content)
            ->through($this->formatters)
            ->then(function ($content) {
                return $content;
            });
    }

    /**
     * Register formatters to the pipeline.
     *
     * @param array $formatters
     * @return $this
     */
    public function setFormatters(array $formatters) : self
    {
        $this->formatters = $formatters;

        return $this;
    }

    /**
     * Add a single formatter.
     *
     * @param string $formatter
     * @return $this
     */
    public function addFormatter(string $formatter) : self
    {
        if (!in_array($formatter, $this->formatters)) {
            $this->formatters[] = $formatter;
        }

        return $this;
    }

    /**
     * Remove a single formatter.
     *
     * @param string $formatter
     * @return $this
     */
    public function removeFormatter(string $formatter) : self
    {
        if (($key = array_search($formatter, $this->formatters)) !== false) {
            unset($this->formatters[$key]);
        }

        return $this;
    }

    /**
     * Sometimes you want to see which formatters are waiting alongside the conveyor.
     *
     * @return array
     */
    public function getFormatters() : array
    {
        return $this->formatters;
    }

    /**
     * Return a container instance for the pipeline to resolve formatter classes.
     *
     * @return \Illuminate\Container\Container
     */
    protected function getContainer() : Container
    {
        return new Container();
    }
}
