<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a data point in a horizontal bar chart.
 */
final class HorizontalBarChartDataValue extends Node
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
     * The color of the bar associated with the data point. Valid values: "good", "warning", "attention",
     * "neutral", "categoricalRed", "categoricalPurple", "categoricalLavender", "categoricalBlue",
     * "categoricalLightBlue", "categoricalTeal", "categoricalGreen", "categoricalLime",
     * "categoricalMarigold", "sequential1", "sequential2", "sequential3", "sequential4", "sequential5",
     * "sequential6", "sequential7", "sequential8", "divergingBlue", "divergingLightBlue", "divergingCyan",
     * "divergingTeal", "divergingYellow", "divergingPeach", "divergingLightRed", "divergingRed",
     * "divergingMaroon", "divergingGray", "sequentialRed1", "sequentialRed2", "sequentialRed3",
     * "sequentialRed4", "sequentialRed5", "sequentialRed6", "sequentialRed7", "sequentialRed8",
     * "sequentialGreen1", "sequentialGreen2", "sequentialGreen3", "sequentialGreen4", "sequentialGreen5",
     * "sequentialGreen6", "sequentialGreen7", "sequentialGreen8", "sequentialYellow1",
     * "sequentialYellow2", "sequentialYellow3", "sequentialYellow4", "sequentialYellow5",
     * "sequentialYellow6", "sequentialYellow7", "sequentialYellow8".
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
