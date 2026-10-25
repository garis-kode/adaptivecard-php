<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Chart\Data\DataPoint;

/**
 * A pie chart.
 */
final class PieChart extends AbstractChart
{
    /**
     * @param iterable<DataPoint|array<string, mixed>>|null $data
     */
    public function __construct(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
    ) {
        $this->title($title);
      
        if ($showTitle !== null) {
            $this->showTitle($showTitle);
        }
        if ($data !== null) {
            $this->data($data);
        }
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>>|null $data
     */
    public static function make(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
    ): self {
        return new self($title, $showTitle, $data);
    }

    /**
     * Add a data point to the pie chart.
     *
     * @param DataPoint|array<string, mixed> $point
     */
    public function addDataPoint(DataPoint|array $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * The data points of the pie chart.
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
     * Controls whether slice outlines are displayed.
     */
    public function showOutlines(bool $show = true): self
    {
        return $this->set('showOutlines', $show);
    }

    public function thickness(string|int|float $thickness): self
    {
        return $this->set('thickness', $thickness);
    }

    public function value(string|int|float $value): self
    {
        return $this->set('value', $value);
    }

    public function valueColor(string $color): self
    {
        return $this->set('valueColor', $color);
    }

    public function getType(): string
    {
        return 'Chart.Pie';
    }
}
