<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Line;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a data point in a line chart series.
 */
final class LineChartValue extends Node
{
    use HasKey;

    public function __construct(
        string|int|float $x,
        float|int $y,
        ?string $key = null,
    ) {
        $this->x($x);
        $this->y($y);
      
        if ($key !== null) {
            $this->key($key);
        }
    }

    public static function make(string|int|float $x, float|int $y, ?string $key = null): self
    {
        return new self($x, $y, $key);
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

    public function getType(): ?string
    {
        return null;
    }
}
