<?php

namespace JeroenG\TextConveyor;

use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline;

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
     * @param string $className
     * @return $this
     */
    public function addFormatter($className) : self
    {
        if (!in_array($className, $this->formatters)) {
            $this->formatters[] = $className;
        }

        return $this;
    }

    /**
     * Remove a single formatter.
     *
     * @param string $className
     * @return $this
     */
    public function removeFormatter(string $className) : self
    {
        if (($key = array_search($className, $this->formatters)) !== false) {
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

    protected function getContainer()
    {
        return new Container();
    }
}
