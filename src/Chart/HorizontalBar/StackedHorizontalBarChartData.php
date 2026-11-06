<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Defines a data series to display in a stacked horizontal bar chart.
 */
final class StackedHorizontalBarChartData extends Node
{
    use HasKey;

    /**
     * @param iterable<StackedHorizontalBarChartDataPoint> $data
     */
    public function __construct(
        string $title,
        iterable $data = [],
        ?string $key = null,
    ) {
        $this->title($title);
        $this->data($data);
        if ($key !== null) {
            $this->key($key);
        }
    }

    /**
     * @param iterable<StackedHorizontalBarChartDataPoint> $data
     */
    public static function make(string $title, iterable $data = [], ?string $key = null): self
    {
        return new self($title, $data, $key);
    }

    /**
     * The title of the series.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * @param StackedHorizontalBarChartDataPoint|iterable<StackedHorizontalBarChartDataPoint> $data
     */
    public function addData(StackedHorizontalBarChartDataPoint|iterable $data): self
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
     * The data points in the series.
     *
     * @param iterable<StackedHorizontalBarChartDataPoint> $points
     */
    public function data(iterable $points): self
    {
        return $this->addData($points);
    }

    public function getType(): ?string
    {
        return null;
    }
}
