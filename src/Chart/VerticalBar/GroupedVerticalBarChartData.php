<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\HorizontalBar\BarChartDataValue;
use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a series of data points in a grouped vertical bar chart.
 */
final class GroupedVerticalBarChartData extends Node
{
    use HasKey;

    /**
     * @param iterable<BarChartDataValue> $values
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
     * @param iterable<BarChartDataValue> $values
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
     * The color to use for all data points in the series. Valid values: "good", "warning", "attention",
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

    /**
     *
     * @param BarChartDataValue|iterable<BarChartDataValue> $point
     */
    public function addValues(BarChartDataValue|iterable $point): self
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
     * @param iterable<BarChartDataValue> $values
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
