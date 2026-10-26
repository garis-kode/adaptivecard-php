<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * A vertical bar chart.
 */
final class VerticalBarChart extends AbstractChart
{
    /**
     * @param iterable<DataPoint> $data
     */
    public function __construct(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
    ) {
        $this->title($title);
        $this->data($data);
      
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
     * @param iterable<DataPoint> $data
     */
    public static function make(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
    ): self {
        return new self($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet);
    }

    /**
     * Add a data point to the chart.
     */
    public function addDataPoint(DataPoint $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * Add multiple data points to the chart.
     *
     * @param iterable<DataPoint> $data
     */
    public function addDataPoints(iterable $data): self
    {
        foreach ($data as $point) {
            $this->addDataPoint($point);
        }

        return $this;
    }

    /**
     * The data points of the chart.
     *
     * @param iterable<DataPoint> $data
     */
    public function data(iterable $data): self
    {
        return $this->addDataPoints($data);
    }

    /**
     * Controls whether the values of the bars should be displayed above each bar.
     */
    public function showBarValues(bool $show = true): self
    {
        return $this->set('showBarValues', $show);
    }

    /**
     * The minimum value to be displayed on the y axis.
     */
    public function yMin(float|int $min): self
    {
        return $this->set('yMin', $min);
    }

    /**
     * The maximum value to be displayed on the y axis.
     */
    public function yMax(float|int $max): self
    {
        return $this->set('yMax', $max);
    }

    public function getType(): string
    {
        return 'Chart.VerticalBar';
    }
}
