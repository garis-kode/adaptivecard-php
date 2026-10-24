<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\ChartSeries;

/**
 * A stacked horizontal bar chart.
 */
final class StackedHorizontalBarChart extends AbstractChart
{
    /**
     * @param iterable<ChartSeries|array<string, mixed>> $data
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
     * @param iterable<ChartSeries|array<string, mixed>> $data
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
     *
     * @param ChartSeries|array<string, mixed> $series
     */
    public function addSeries(ChartSeries|array $series): self
    {
        return $this->push('data', $series);
    }

    /**
     * The series of data points in the stacked horizontal bar chart.
     *
     * @param iterable<ChartSeries|array<string, mixed>> $data
     */
    public function data(iterable $data): self
    {
        foreach ($data as $series) {
            $this->addSeries($series);
        }

        return $this;
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar.Stacked';
    }
}
