<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\VerticalBar;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Enum\ChartColorSet;

final class VerticalBarChart extends AbstractChart
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
        string|ChartColorSet|null $colorSet = null,
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
        string|ChartColorSet|null $colorSet = null,
    ): self {
        return new self($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet);
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
