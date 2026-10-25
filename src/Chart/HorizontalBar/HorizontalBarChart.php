<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Enum\ChartColorSet;

/**
 * A horizontal bar chart.
 */
final class HorizontalBarChart extends AbstractChart
{
    /**
     * @param iterable<DataPoint|array<string, mixed>> $data
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
     * @param iterable<DataPoint|array<string, mixed>> $data
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
     *
     * @param DataPoint|array<string, mixed> $point
     */
    public function addDataPoint(DataPoint|array $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * The data points of the chart.
     *
     * @param iterable<DataPoint|array<string, mixed>> $data
     */
    public function data(iterable $data): self
    {
        foreach ($data as $point) {
            $this->addDataPoint($point);
        }

        return $this;
    }

    /**
     * Controls whether the chart is displayed in standard or parts-to-whole mode.
     */
    public function displayMode(string $mode): self
    {
        return $this->set('displayMode', $mode);
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar';
    }
}
