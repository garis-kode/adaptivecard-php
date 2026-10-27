<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ChartColor;
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
     * The name of the set of colors to use to render the chart. See Chart colors reference.
     * Valid values: "categorical", "sequential", "sequentialred", "sequentialgreen", "sequentialyellow", "diverging".
     */
    public function colorSet(ChartColorSet $colorSet): static
    {
        return $this->set('colorSet', $colorSet->value);
    }

    /**
     * The color to use for all data points. See Chart colors reference.
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

    /**
     * The maximum width, in pixels, of the chart, in the <number>px format.
     * Valid values: "<number>px".
     */
    public function maxWidth(string $maxWidth): static
    {
        return $this->set('maxWidth', $maxWidth);
    }

    /**
     * Controls whether the chart's legend should be displayed.
     */
    public function showLegend(bool $show = true): static
    {
        return $this->set('showLegend', $show);
    }

    /**
     * Controls whether the chart's title should be displayed. Defaults to false.
     */
    public function showTitle(bool $show = true): static
    {
        return $this->set('showTitle', $show);
    }
}
