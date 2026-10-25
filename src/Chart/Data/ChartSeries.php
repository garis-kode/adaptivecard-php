<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Data;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;

/**
 * Represents a collection of data points series in a line chart or stacked/grouped chart.
 */
final class ChartSeries extends Node
{
    /**
     * @param iterable<DataPoint> $data
     */
    public function __construct(
        ?string $legendOrTitle = null,
        iterable $data = [],
        ?ChartColor $color = null,
    ) {
        if ($legendOrTitle !== null) {
            $this->legend($legendOrTitle);
        }
        if ($color !== null) {
            $this->color($color);
        }
        foreach ($data as $point) {
            $this->addPoint($point);
        }
    }

    /**
     * @param iterable<DataPoint> $data
     */
    public static function make(?string $legendOrTitle = null, iterable $data = [], ?ChartColor $color = null): self
    {
        return new self($legendOrTitle, $data, $color);
    }

    /**
     * The legend/label for this series.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The title of this series.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The color of this series.
     */
    public function color(ChartColor $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Add a data point to the series.
     */
    public function addPoint(DataPoint $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * Add multiple data points to the series.
     *
     * @param iterable<DataPoint> $points
     */
    public function addPoints(iterable $points): self
    {
        foreach ($points as $point) {
            $this->addPoint($point);
        }

        return $this;
    }

    /**
     * The collection of data points in this series.
     *
     * @param iterable<DataPoint> $points
     */
    public function data(iterable $points): self
    {
        return $this->addPoints($points);
    }

    /**
     * Add a value data point to the series.
     */
    public function addValue(DataPoint $point): self
    {
        return $this->push('values', $point);
    }

    /**
     * Add multiple value data points to the series.
     *
     * @param iterable<DataPoint> $points
     */
    public function addValues(iterable $points): self
    {
        foreach ($points as $point) {
            $this->addValue($point);
        }

        return $this;
    }

    /**
     * The collection of values in this series.
     *
     * @param iterable<DataPoint> $points
     */
    public function values(iterable $points): self
    {
        return $this->addValues($points);
    }

    public function getType(): ?string
    {
        return null;
    }
}
