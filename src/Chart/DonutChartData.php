<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * A data point in a donut or pie chart.
 */
final class DonutChartData extends Node
{
    use HasKey;

    public function __construct(
        string $legend,
        float|int $value,
        ?ChartColor $color = null,
        ?string $key = null,
    ) {
        $this->legend($legend);
        $this->value($value);
       
        if ($color !== null) {
            $this->color($color);
        }
        if ($key !== null) {
            $this->key($key);
        }
    }

    public static function make(string $legend, float|int $value, ?ChartColor $color = null, ?string $key = null): self
    {
        return new self($legend, $value, $color, $key);
    }

    /**
     * The legend of the chart.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The value associated with the data point.
     */
    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The color to use for the data point.
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
