<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\ChartSeries;

final class GroupedVerticalBarChart extends AbstractChart
{
    public static function make(?string $title = null): self
    {
        $chart = new self();
        if ($title !== null) {
            $chart->title($title);
        }

        return $chart;
    }

    public function stacked(bool $stacked = true): self
    {
        return $this->set('stacked', $stacked);
    }

    /**
     * @param ChartSeries|array<string, mixed> $series
     */
    public function addSeries(ChartSeries|array $series): self
    {
        return $this->push('data', $series);
    }

    /**
     * @param iterable<ChartSeries|array<string, mixed>> $data
     */
    public function data(iterable $data): self
    {
        foreach ($data as $series) {
            $this->addSeries($series);
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
        return 'Chart.VerticalBar.Grouped';
    }
}
