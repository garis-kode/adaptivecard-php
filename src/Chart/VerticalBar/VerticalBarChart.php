<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractCartesianChart;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * A vertical bar chart.
 */
final class VerticalBarChart extends AbstractCartesianChart
{
    /**
     * @param iterable<VerticalBarChartDataValue> $data
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
     * @param iterable<VerticalBarChartDataValue> $data
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
     * Add data to the vertical bar chart (accepts a single item or an iterable of items).
     *
     * @param VerticalBarChartDataValue|iterable<VerticalBarChartDataValue> $data
     */
    public function addData(VerticalBarChartDataValue|iterable $data): self
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
     * The data to display in the chart.
     * Valid values: "VerticalBarChartDataValue".
     *
     * @param iterable<VerticalBarChartDataValue> $data
     */
    public function data(iterable $data): self
    {
        return $this->addData($data);
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
