<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Node;

/**
 * The legend of the chart.
 */
final class GaugeSegment extends Node
{
    public function __construct(string $legend, float|int $size, ?string $color = null)
    {
        $this->legend($legend);
        $this->size($size);
       
        if ($color !== null) {
            $this->color($color);
        }
    }

    public static function make(string $legend, float|int $size, ?string $color = null): self
    {
        return new self($legend, $size, $color);
    }

    /**
     * Label for the segment.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The size/range of the segment.
     */
    public function size(float|int $size): self
    {
        return $this->set('size', $size);
    }

    /**
     * The color of the segment.
     */
    public function color(string $color): self
    {
        return $this->set('color', $color);
    }

    public function getType(): ?string
    {
        return null;
    }
}
