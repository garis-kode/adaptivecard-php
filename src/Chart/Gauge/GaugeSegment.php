<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Node;

/**
 * Segment definition for a GaugeChart.
 */
final class GaugeSegment extends Node
{
    public function __construct(string $legend, float|int $size, ?string $color = null)
    {
        $this->set('legend', $legend);
        $this->set('size', $size);
        $this->set('color', $color);
    }

    public static function make(string $legend, float|int $size, ?string $color = null): self
    {
        return new self($legend, $size, $color);
    }

    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    public function size(float|int $size): self
    {
        return $this->set('size', $size);
    }

    public function color(string $color): self
    {
        return $this->set('color', $color);
    }

    public function getType(): ?string
    {
        return null;
    }
}
