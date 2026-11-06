<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractCartesianChart;

/**
 * A stacked horizontal bar chart.
 */
final class StackedHorizontalBarChart extends AbstractCartesianChart
{
    /**
     * @param iterable<StackedHorizontalBarChartData> $data
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
     * @param iterable<StackedHorizontalBarChartData> $data
     */
    public static function make(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
    ): self {
        return new self($title, $data, $showTitle);
    }

    /**
     * @param StackedHorizontalBarChartData|iterable<StackedHorizontalBarChartData> $data
     */
    public function addData(StackedHorizontalBarChartData|iterable $data): self
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
     * Valid values: "StackedHorizontalBarChartData".
     *
     * @param iterable<StackedHorizontalBarChartData> $data
     */
    public function data(iterable $data): self
    {
        return $this->addData($data);
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar.Stacked';
    }
}
