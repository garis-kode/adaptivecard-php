<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\HorizontalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\DataPoint;

final class HorizontalBarChart extends AbstractChart
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

    public function displayMode(string $mode): self
    {
        return $this->set('displayMode', $mode);
    }

    public function getType(): string
    {
        return 'Chart.HorizontalBar';
    }
}
