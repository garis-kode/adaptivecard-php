<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\ChartSeries;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * A grouped vertical bar chart.
 */
final class GroupedVerticalBarChart extends AbstractChart
{
    /**
     * @param iterable<ChartSeries>|null $data
     */
    public function __construct(
        string $title,
        ?iterable $data = null,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
    ) {
        $this->title($title);
      
        if ($data !== null) {
            $this->data($data);
        }
        if ($showTitle !== null) {
            $this->showTitle($showTitle);
        }
        if ($xAxisTitle !== null) {
            $this->xAxisTitle($xAxisTitle);
        }
        if ($yAxisTitle !== null) {
            $this->yAxisTitle($yAxisTitle);
        }
        if ($colorSet !== null) {
            $this->colorSet($colorSet);
        }
    }

    /**
     * @param iterable<ChartSeries>|null $data
     */
    public static function make(
        string $title,
        ?iterable $data = null,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
    ): self {
        return new self($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet);
    }

    /**
     * Controls if bars in the chart should be displayed as stacks instead of groups. Note: stacked vertical bar charts do not support custom Y ranges nor negative Y values.
     */
    public function stacked(bool $stacked = true): self
    {
        return $this->set('stacked', $stacked);
    }

    /**
     * Add a series of data points.
     */
    public function addSeries(ChartSeries $series): self
    {
        return $this->push('data', $series);
    }

    /**
     * Add multiple series of data points.
     *
     * @param iterable<ChartSeries> $data
     */
    public function addSeriesList(iterable $data): self
    {
        foreach ($data as $series) {
            $this->addSeries($series);
        }

        return $this;
    }

    /**
     * The data points in a series.
     * Valid values: "GroupedVerticalBarChartData".
     *
     * @param iterable<ChartSeries> $data
     */
    public function data(iterable $data): self
    {
        return $this->addSeriesList($data);
    }

    /**
     * Controls if values should be displayed on each bar.
     */
    public function showBarValues(bool $show = true): self
    {
        return $this->set('showBarValues', $show);
    }

    /**
     * The requested minimum for the Y axis range. The value used at runtime may be different to optimize visual presentation. `yMin` is ignored if `stacked` is set to true.
     */
    public function yMin(float|int $min): self
    {
        return $this->set('yMin', $min);
    }

    /**
     * The requested maximum for the Y axis range. The value used at runtime may be different to optimize visual presentation. `yMax` is ignored if `stacked` is set to true.
     */
    public function yMax(float|int $max): self
    {
        return $this->set('yMax', $max);
    }

    public function getType(): string
    {
        return 'Chart.VerticalBar.Grouped';
    }
}
