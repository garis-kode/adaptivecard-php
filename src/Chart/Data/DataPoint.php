<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Data;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;

/**
 * A single data point in a chart or chart series.
 */
final class DataPoint extends Node
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        string|int|float|null $xOrLegend = null,
        string|int|float|null $yOrValue = null,
        ?ChartColor $color = null,
        array $extra = [],
    ) {
        if ($xOrLegend !== null) {
            $this->properties['x'] = $xOrLegend;
        }
        if ($yOrValue !== null) {
            $this->properties['y'] = $yOrValue;
        }
        if ($color !== null) {
            $this->properties['color'] = $color->value;
        }
        foreach ($extra as $key => $val) {
            $this->set($key, $val);
        }
    }

    /**
     * Create a cartesian data point with x and y coordinates.
     */
    public static function point(string|int|float $x, string|int|float $y, ?ChartColor $color = null): self
    {
        $dp = new self();
        $dp->set('x', $x);
        $dp->set('y', $y);
        if ($color !== null) {
            $dp->set('color', $color->value);
        }

        return $dp;
    }

    /**
     * Create a slice/legend data point for pie, donut, or bar charts.
     */
    public static function slice(string $legend, float|int $value, ?ChartColor $color = null): self
    {
        $dp = new self();
        $dp->set('legend', $legend);
        $dp->set('value', $value);
        if ($color !== null) {
            $dp->set('color', $color->value);
        }

        return $dp;
    }

    /**
     * The x axis value of the data point.
     */
    public function x(string|int|float $x): self
    {
        return $this->set('x', $x);
    }

    /**
     * The y axis value of the data point.
     */
    public function y(string|int|float $y): self
    {
        return $this->set('y', $y);
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
