<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractCartesianChart;
use AdaptiveCards\Chart\Data\ChartSeries;

/**
 * A stacked horizontal bar chart.
 */
final class StackedHorizontalBarChart extends AbstractCartesianChart
{
    /**
     * @param iterable<ChartSeries> $data
     */
    public function __construct(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
    ) {
        $this->title($title);
        $this->data($data);
       
        if ($showTitle !== null) {
            $this->showTitle($showTitle);
        }
    }

    /**
     * @param iterable<ChartSeries> $data
     */
    public static function make(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
    ): self {
        return new self($title, $data, $showTitle);
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
     * The data to display in the chart.
     * Valid values: "StackedHorizontalBarChartData".
     *
     * @param iterable<ChartSeries> $data
     */
    public function data(iterable $data): self
    {
        return $this->addSeriesList($data);
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar.Stacked';
    }
}
