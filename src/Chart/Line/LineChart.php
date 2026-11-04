<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Line;

use AdaptiveCards\Chart\AbstractCartesianChart;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Enum\Width;

/**
 * A line chart.
 */
final class LineChart extends AbstractCartesianChart
{
    /**
     * @param iterable<LineChartData>|null $data
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
     * @param iterable<LineChartData>|null $data
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
     * Add data to the line chart (accepts a single series or an iterable of series).
     *
     * @param LineChartData|iterable<LineChartData> $data
     */
    public function addData(LineChartData|iterable $data): self
    {
        if (is_iterable($data)) {
            foreach ($data as $item) {
                $this->push('data', $item);
            }

            return $this;
        }

        return $this->push('data', $data);
    }

    /**
     * The data point series in the line chart.
     * Valid values: "LineChartData".
     *
     * @param iterable<LineChartData> $data
     */
    public function data(iterable $data): self
    {
        return $this->addData($data);
    }

    public function getType(): string
    {
        return 'Chart.Line';
    }
}
