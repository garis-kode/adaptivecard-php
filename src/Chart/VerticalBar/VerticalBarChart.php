<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\DataPoint;

final class VerticalBarChart extends AbstractChart
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

    public function showBarValues(bool $show = true): self
    {
        return $this->set('showBarValues', $show);
    }

    public function yMin(float|int $min): self
    {
        return $this->set('yMin', $min);
    }

    public function yMax(float|int $max): self
    {
        return $this->set('yMax', $max);
    }

    public function getType(): string
    {
        return 'Chart.VerticalBar';
    }
}
