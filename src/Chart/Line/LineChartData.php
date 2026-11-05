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
     * The color all data points in the series. Valid values: "good", "warning", "attention", "neutral",
     * "categoricalRed", "categoricalPurple", "categoricalLavender", "categoricalBlue",
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

    /**
     *
     * @param LineChartValue|iterable<LineChartValue> $point
     */
    public function addValues(LineChartValue|iterable $point): self
    {
        if (is_iterable($point)) {
            foreach ($point as $item) {
                $this->push('values', $item);
            }

            return $this;
        }

        return $this->push('values', $point);
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
