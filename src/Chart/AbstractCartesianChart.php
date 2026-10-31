<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Enum\ChartColor;

/**
 * Base class for charts rendered against x and y axes.
 */
abstract class AbstractCartesianChart extends AbstractChart
{
    /**
     * The color to use for all data points.
     * Valid values: "good", "warning", "attention", "neutral", "categoricalRed", "categoricalPurple",
     * "categoricalLavender", "categoricalBlue", "categoricalLightBlue", "categoricalTeal",
     * "categoricalGreen", "categoricalLime", "categoricalMarigold", "sequential1", "sequential2",
     * "sequential3", "sequential4", "sequential5", "sequential6", "sequential7", "sequential8",
     * "divergingBlue", "divergingLightBlue", "divergingCyan", "divergingTeal", "divergingYellow",
     * "divergingPeach", "divergingLightRed", "divergingRed", "divergingMaroon", "divergingGray",
     * "sequentialRed1", "sequentialRed2", "sequentialRed3", "sequentialRed4", "sequentialRed5",
     * "sequentialRed6", "sequentialRed7", "sequentialRed8", "sequentialGreen1", "sequentialGreen2",
     * "sequentialGreen3", "sequentialGreen4", "sequentialGreen5", "sequentialGreen6",
     * "sequentialGreen7", "sequentialGreen8", "sequentialYellow1", "sequentialYellow2",
     * "sequentialYellow3", "sequentialYellow4", "sequentialYellow5", "sequentialYellow6",
     * "sequentialYellow7", "sequentialYellow8".
     */
    public function color(ChartColor $color): static
    {
        return $this->set('color', $color->value);
    }

    /**
     * The title of the x axis.
     */
    public function xAxisTitle(string $xAxisTitle): static
    {
        return $this->set('xAxisTitle', $xAxisTitle);
    }

    /**
     * The title of the y axis.
     */
    public function yAxisTitle(string $yAxisTitle): static
    {
        return $this->set('yAxisTitle', $yAxisTitle);
    }
}
