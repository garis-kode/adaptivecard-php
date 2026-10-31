<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractCartesianChart;
use AdaptiveCards\Chart\Data\BarChartDataValue;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Enum\ChartDisplayMode;

/**
 * A horizontal bar chart.
 */
final class HorizontalBarChart extends AbstractCartesianChart
{
    /**
     * @param iterable<HorizontalBarChartDataValue|BarChartDataValue> $data
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
     * @param iterable<HorizontalBarChartDataValue|BarChartDataValue> $data
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
     * Add data to the horizontal bar chart (accepts a single item or an iterable of items).
     *
     * @param HorizontalBarChartDataValue|BarChartDataValue|iterable<HorizontalBarChartDataValue|BarChartDataValue> $data
     */
    public function addData(HorizontalBarChartDataValue|BarChartDataValue|iterable $data): self
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
     * Add multiple data items to the horizontal bar chart.
     *
     * @param iterable<HorizontalBarChartDataValue|BarChartDataValue> $data
     */
    public function addDataList(iterable $data): self
    {
        return $this->addData($data);
    }

    /**
     * The data to display in the chart.
     * Valid values: "HorizontalBarChartDataValue".
     *
     * @param iterable<HorizontalBarChartDataValue|BarChartDataValue> $data
     */
    public function data(iterable $data): self
    {
        return $this->addData($data);
    }

    /**
     * Controls how the chart should be visually laid out.
     * Valid values: "AbsoluteWithAxis", "AbsoluteNoAxis", "PartToWhole".
     */
    public function displayMode(ChartDisplayMode $mode): self
    {
        return $this->set('displayMode', $mode->value);
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar';
    }
}
