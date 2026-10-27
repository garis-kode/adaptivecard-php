<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Chart\Data\ChartSeries;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Enum\Width;

/**
 * A line chart.
 */
final class LineChart extends AbstractChart
{
    /**
     * @param iterable<ChartSeries>|null $data
     */
    public function __construct(
        string $title,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?iterable $data = null,
    ) {
        $this->title($title);
     
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
        if ($data !== null) {
            $this->data($data);
        }
    }

    /**
     * @param iterable<ChartSeries>|null $data
     */
    public static function make(
        string $title,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?iterable $data = null,
    ): self {
        return new self($title, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet, $data);
    }

    /**
     * The maximum y range.
     */
    public function yMin(float|int $yMin): self
    {
        return $this->set('yMin', $yMin);
    }

    /**
     * The minimum y range.
     */
    public function yMax(float|int $yMax): self
    {
        return $this->set('yMax', $yMax);
    }

    /**
     * The minimum width reserved for the x axis labels. When the available space is insufficient, the chart selectively renders fewer labels instead of truncating them. auto will automatically adjust the labels' minimum width according to its content and using the <number>px format will give the labels an explicit minimum width in pixels.
     * Valid values: "auto", "<number>px".
     */
    public function xAxisLabelMinWidth(Width|string $width): self
    {
        $value = $width instanceof Width ? $width->value : $width;

        return $this->set('xAxisLabelMinWidth', $value);
    }

    /**
     * Add a series of data points to the line chart.
     */
    public function addSeries(ChartSeries $series): self
    {
        return $this->push('data', $series);
    }

    /**
     * Add multiple series of data points to the line chart.
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
     * The data point series in the line chart.
     * Valid values: "LineChartData".
     *
     * @param iterable<ChartSeries> $data
     */
    public function data(iterable $data): self
    {
        return $this->addSeriesList($data);
    }

    public function getType(): string
    {
        return 'Chart.Line';
    }
}
