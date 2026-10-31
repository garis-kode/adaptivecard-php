<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a data point in a vertical bar chart.
 */
final class VerticalBarChartDataValue extends Node
{
    use HasKey;

    public function __construct(
        string|int|float $x,
        float|int $y,
        ?ChartColor $color = null,
        ?string $key = null,
    ) {
        $this->x($x);
        $this->y($y);
        if ($color !== null) {
            $this->color($color);
        }
        if ($key !== null) {
            $this->key($key);
        }
    }

    public static function make(
        string|int|float $x,
        float|int $y,
        ?ChartColor $color = null,
        ?string $key = null,
    ): self {
        return new self($x, $y, $color, $key);
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
    public function y(float|int $y): self
    {
        return $this->set('y', $y);
    }

    /**
     * The color to use for the bar associated with the data point.
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
