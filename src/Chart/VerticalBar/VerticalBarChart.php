<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractCartesianChart;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * A vertical bar chart.
 */
final class VerticalBarChart extends AbstractCartesianChart
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
     * Add a data point to the vertical bar chart.
     */
    public function addDataPoint(DataPoint $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * Add multiple data points to the vertical bar chart.
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
     * The data to display in the chart.
     * Valid values: "VerticalBarChartDataValue".
     *
     * @param iterable<DataPoint> $data
     */
    public function data(iterable $data): self
    {
        return $this->addDataPoints($data);
    }

    /**
     * Controls if the bar values should be displayed.
     */
    public function showBarValues(bool $show = true): self
    {
        return $this->set('showBarValues', $show);
    }

    /**
     * The requested minimum for the Y axis range. The value used at runtime may be different to optimize visual presentation.
     */
    public function yMin(float|int $min): self
    {
        return $this->set('yMin', $min);
    }

    /**
     * The requested maximum for the Y axis range. The value used at runtime may be different to optimize visual presentation.
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
