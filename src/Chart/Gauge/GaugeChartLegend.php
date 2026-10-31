<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * The legend of the gauge chart.
 */
final class GaugeChartLegend extends Node
{
    use HasKey;

    public function __construct(
        string $legend,
        float|int $size,
        ?ChartColor $color = null,
        ?string $key = null,
    ) {
        $this->legend($legend);
        $this->size($size);
        
        if ($color !== null) {
            $this->color($color);
        }
        if ($key !== null) {
            $this->key($key);
        }
    }

    public static function make(string $legend, float|int $size, ?ChartColor $color = null, ?string $key = null): self
    {
        return new self($legend, $size, $color, $key);
    }

    /**
     * The legend text associated with the segment.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The size of the segment.
     */
    public function size(float|int $size): self
    {
        return $this->set('size', $size);
    }

    /**
     * The color to use for the segment.
     */
    public function color(ChartColor $color): self
    {
        return $this->set('color', $color->value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
