<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Donut;

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
     * Valid values: "good", "warning", "attention", "neutral",
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

    public function getType(): ?string
    {
        return null;
    }
}
