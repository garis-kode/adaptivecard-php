<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Data;

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
        ?string $color = null,
        array $extra = [],
    ) {
        if ($xOrLegend !== null) {
            $this->properties['x'] = $xOrLegend;
        }
        if ($yOrValue !== null) {
            $this->properties['y'] = $yOrValue;
        }
        if ($color !== null) {
            $this->properties['color'] = $color;
        }
        foreach ($extra as $key => $val) {
            $this->set($key, $val);
        }
    }

    public static function point(string|int|float $x, string|int|float $y, ?string $color = null): self
    {
        $dp = new self();
        $dp->set('x', $x);
        $dp->set('y', $y);
        if ($color !== null) {
            $dp->set('color', $color);
        }

        return $dp;
    }

    public static function slice(string $legend, float|int $value, ?string $color = null, ?string $tooltip = null): self
    {
        $dp = new self();
        $dp->set('legend', $legend);
        $dp->set('value', $value);
        if ($color !== null) {
            $dp->set('color', $color);
        }
        if ($tooltip !== null) {
            $dp->set('tooltip', $tooltip);
        }

        return $dp;
    }

    /**
     * The x-axis value (string, number, or date).
     */
    public function x(string|int|float $x): self
    {
        return $this->set('x', $x);
    }

    /**
     * The y-axis value.
     */
    public function y(string|int|float $y): self
    {
        return $this->set('y', $y);
    }

    /**
     * Label for this data point.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * Value of this data point.
     */
    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * Color identifier or hex color for this data point.
     */
    public function color(string $color): self
    {
        return $this->set('color', $color);
    }

    /**
     * Tooltip text to display on hover.
     */
    public function tooltip(string $tooltip): self
    {
        return $this->set('tooltip', $tooltip);
    }

    public function getType(): ?string
    {
        return null;
    }
}
