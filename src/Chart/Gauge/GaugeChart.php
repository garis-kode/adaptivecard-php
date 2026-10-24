<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Chart\AbstractChart;

final class GaugeChart extends AbstractChart
{
    public static function make(?string $title = null, float|int|null $value = null): self
    {
        $chart = new self();
        if ($title !== null) {
            $chart->title($title);
        }
        if ($value !== null) {
            $chart->value($value);
        }

        return $chart;
    }

    public function showTitle(bool $showTitle = true): self
    {
        return $this->set('showTitle', $showTitle);
    }

    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    public function min(float|int $min): self
    {
        return $this->set('min', $min);
    }

    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    public function target(float|int $target): self
    {
        return $this->set('target', $target);
    }

    /**
     * @param GaugeSegment|array<string, mixed> $segment
     */
    public function addSegment(GaugeSegment|array $segment): self
    {
        return $this->push('segments', $segment);
    }

    /**
     * @param iterable<GaugeSegment|array<string, mixed>> $segments
     */
    public function segments(iterable $segments): self
    {
        foreach ($segments as $segment) {
            $this->addSegment($segment);
        }

        return $this;
    }

    public function getType(): string
    {
        return 'Chart.Gauge';
    }
}
