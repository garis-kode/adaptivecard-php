<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Chart\Data\ChartSeries;
use AdaptiveCards\Enum\ChartColorSet;

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
     * Minimum y-axis value.
     */
    public function yMin(float|int $yMin): self
    {
        return $this->set('yMin', $yMin);
    }

    /**
     * The maximum value to be displayed on the y axis.
     */
    public function yMax(float|int $yMax): self
    {
        return $this->set('yMax', $yMax);
    }

    /**
     * Controls the minimum width allocated to x axis labels.
     * Valid values: "<number>px" or an integer for pixel count.
     */
    public function xAxisLabelMinWidth(string|int $width): self
    {
        return $this->set('xAxisLabelMinWidth', $width);
    }

    /**
     * Add a data series to the chart.
     */
    public function addSeries(ChartSeries $series): self
    {
        return $this->push('data', $series);
    }

    /**
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
