<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Chart\Data\DataPoint;

final class PieChart extends AbstractChart
{
    public static function make(?string $title = null): self
    {
        $chart = new self();
        if ($title !== null) {
            $chart->title($title);
        }

        return $chart;
    }

    /**
     * @param DataPoint|array<string, mixed> $point
     */
    public function addDataPoint(DataPoint|array $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>> $data
     */
    public function data(iterable $data): self
    {
        foreach ($data as $point) {
            $this->addDataPoint($point);
        }

        return $this;
    }

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
