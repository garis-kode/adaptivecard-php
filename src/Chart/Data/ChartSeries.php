<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Data;

use AdaptiveCards\Node;

/**
 * Series data for multi-series charts (Line, StackedBar, GroupedBar).
 */
final class ChartSeries extends Node
{
    /**
     * @param iterable<DataPoint|array<string, mixed>> $data
     */
    public function __construct(
        ?string $legendOrTitle = null,
        iterable $data = [],
        ?string $color = null,
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
     * @param iterable<DataPoint|array<string, mixed>> $data
     */
    public static function make(?string $legendOrTitle = null, iterable $data = [], ?string $color = null): self
    {
        return new self($legendOrTitle, $data, $color);
    }

    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function color(string $color): self
    {
        return $this->set('color', $color);
    }

    /**
     * @param DataPoint|array<string, mixed> $point
     */
    public function addPoint(DataPoint|array $point): self
    {
        return $this->push('data', $point);
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>> $points
     */
    public function data(iterable $points): self
    {
        foreach ($points as $point) {
            $this->addPoint($point);
        }

        return $this;
    }

    /**
     * @param DataPoint|array<string, mixed> $point
     */
    public function addValue(DataPoint|array $point): self
    {
        return $this->push('values', $point);
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>> $points
     */
    public function values(iterable $points): self
    {
        foreach ($points as $point) {
            $this->addValue($point);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return null;
    }
}
