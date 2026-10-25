<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Enum\ChartThickness;

/**
 * A donut chart.
 */
final class DonutChart extends AbstractChart
{
    /**
     * @param iterable<DataPoint>|null $data
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
     * @param iterable<DataPoint>|null $data
     */
    public static function make(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
    ): self {
        return new self($title, $showTitle, $data);
    }

    /**
     * Controls whether slice outlines are displayed.
     */
    public function showOutlines(bool $show = true): self
    {
        return $this->set('showOutlines', $show);
    }

    /**
     * Thickness of the donut ring.
     * Valid values: "Thin", "Thick".
     */
    public function thickness(ChartThickness $thickness): self
    {
        return $this->set('thickness', $thickness->value);
    }

    /**
     * The central value displayed inside the donut chart.
     */
    public function value(string|int|float $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * Color of the central value text.
     */
    public function valueColor(ChartColor $color): self
    {
        return $this->set('valueColor', $color->value);
    }

    public function addDataPoint(DataPoint $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * @param iterable<DataPoint> $data
     */
    public function addDataPoints(iterable $data): self
    {
        foreach ($data as $point) {
            $this->addDataPoint($point);
        }

        return $this;
    }

    /**
     * @param iterable<DataPoint> $data
     */
    public function data(iterable $data): self
    {
        return $this->addDataPoints($data);
    }

    public function getType(): string
    {
        return 'Chart.Donut';
    }
}
