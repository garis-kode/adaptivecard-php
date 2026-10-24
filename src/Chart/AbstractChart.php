<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * Base class for all Chart elements.
 */
abstract class AbstractChart extends AbstractElement
{
    /**
     * The title of the chart.
     */
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    /**
     * Controls the color set used to style the chart.
     * Valid values: "categorical", "sequential", "diverging", "sequentialRed", "sequentialGreen", "sequentialYellow".
     */
    public function colorSet(string|ChartColorSet $colorSet): static
    {
        return $this->set('colorSet', ChartColorSet::value($colorSet));
    }

    /**
     * Controls the color of the chart when a single color is used.
     */
    public function color(string $color): static
    {
        return $this->set('color', $color);
    }

    /**
     * The title of the x-axis.
     */
    public function xAxisTitle(string $xAxisTitle): static
    {
        return $this->set('xAxisTitle', $xAxisTitle);
    }

    /**
     * The title of the y-axis.
     */
    public function yAxisTitle(string $yAxisTitle): static
    {
        return $this->set('yAxisTitle', $yAxisTitle);
    }

    /**
     * Controls the maximum width of the chart.
     */
    public function maxWidth(string $maxWidth): static
    {
        return $this->set('maxWidth', $maxWidth);
    }

    /**
     * Controls whether the chart legend is visible.
     */
    public function showLegend(bool $show = true): static
    {
        return $this->set('showLegend', $show);
    }

    /**
     * Controls whether the chart title is visible.
     */
    public function showTitle(bool $show = true): static
    {
        return $this->set('showTitle', $show);
    }
}
