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
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    public function colorSet(string|ChartColorSet $colorSet): static
    {
        return $this->set('colorSet', ChartColorSet::value($colorSet));
    }

    public function color(string $color): static
    {
        return $this->set('color', $color);
    }

    public function xAxisTitle(string $xAxisTitle): static
    {
        return $this->set('xAxisTitle', $xAxisTitle);
    }

    public function yAxisTitle(string $yAxisTitle): static
    {
        return $this->set('yAxisTitle', $yAxisTitle);
    }

    public function maxWidth(string $maxWidth): static
    {
        return $this->set('maxWidth', $maxWidth);
    }

    public function showLegend(bool $show = true): static
    {
        return $this->set('showLegend', $show);
    }

    public function showTitle(bool $show = true): static
    {
        return $this->set('showTitle', $show);
    }
}
