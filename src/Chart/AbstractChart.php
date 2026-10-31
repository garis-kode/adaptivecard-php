<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

abstract class AbstractChart extends AbstractBlockElement
{
    use HasHeight, HasHorizontalAlignment, HasSpacing;
    /**
     * The title of the chart.
     */
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    /**
     * The name of the set of colors to use to render the chart.
     * Valid values: "categorical", "sequential", "sequentialred", "sequentialgreen", "sequentialyellow", "diverging".
     */
    public function colorSet(ChartColorSet $colorSet): static
    {
        return $this->set('colorSet', $colorSet->value);
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
