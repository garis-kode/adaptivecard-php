<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Line;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a series of data points in a line chart.
 */
final class LineChartData extends Node
{
    use HasKey;

    /**
     * @param iterable<LineChartValue> $values
     */
    public function __construct(
        string $legend,
        iterable $values = [],
        ?ChartColor $color = null,
        ?string $key = null,
    ) {
        $this->legend($legend);
       
        if ($color !== null) {
            $this->color($color);
        }
        $this->values($values);
        if ($key !== null) {
            $this->key($key);
        }
    }

    /**
     * @param iterable<LineChartValue> $values
     */
    public static function make(
        string $legend,
        iterable $values = [],
        ?ChartColor $color = null,
        ?string $key = null,
    ): self {
        return new self($legend, $values, $color, $key);
    }

    /**
     * The legend of the chart.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The color to use for all data points in the series.
     */
    public function color(ChartColor $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Add a value data point to the series.
     */
    public function addValue(LineChartValue $point): self
    {
        return $this->push('values', $point);
    }

    /**
     * Add multiple value data points to the series.
     *
     * @param iterable<LineChartValue> $values
     */
    public function addValues(iterable $values): self
    {
        foreach ($values as $point) {
            $this->addValue($point);
        }

        return $this;
    }

    /**
     * The data points in the series.
     *
     * @param iterable<LineChartValue> $values
     */
    public function values(iterable $values): self
    {
        return $this->addValues($values);
    }

    public function getType(): ?string
    {
        return null;
    }
}
