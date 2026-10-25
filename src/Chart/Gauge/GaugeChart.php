<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Chart\AbstractChart;

/**
 * A gauge chart.
 */
final class GaugeChart extends AbstractChart
{
    /**
     * @param iterable<GaugeSegment|array<string, mixed>>|null $segments
     */
    public function __construct(
        string $title,
        ?bool $showTitle = null,
        float|int|null $value = null,
        ?iterable $segments = null,
    ) {
        $this->title($title);
       
        if ($showTitle !== null) {
            $this->showTitle($showTitle);
        }
        if ($value !== null) {
            $this->value($value);
        }
        if ($segments !== null) {
            $this->segments($segments);
        }
    }

    /**
     * @param iterable<GaugeSegment|array<string, mixed>>|null $segments
     */
    public static function make(
        string $title,
        ?bool $showTitle = null,
        float|int|null $value = null,
        ?iterable $segments = null,
    ): self {
        return new self($title, $showTitle, $value, $segments);
    }

    /**
     * The current value of the gauge.
     */
    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The minimum value of the gauge.
     */
    public function min(float|int $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The maximum value of the gauge.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * The target value indicator on the gauge.
     */
    public function target(float|int $target): self
    {
        return $this->set('target', $target);
    }

    /**
     * Add a segment to the gauge chart.
     *
     * @param GaugeSegment|array<string, mixed> $segment
     */
    public function addSegment(GaugeSegment|array $segment): self
    {
        return $this->push('segments', $segment);
    }

    /**
     * The collection of segments in the gauge chart.
     *
     * @param iterable<GaugeSegment|array<string, mixed>> $segments
     */
    public function segments(iterable $segments): self
    {
        foreach ($segments as $segment) {
            $this->addSegment($segment);
        }

        return $this;
    }

    /**
     * Controls whether min/max labels are displayed.
     */
    public function showMinMax(bool $show = true): self
    {
        return $this->set('showMinMax', $show);
    }

    /**
     * Controls whether the needle is displayed.
     */
    public function showNeedle(bool $show = true): self
    {
        return $this->set('showNeedle', $show);
    }

    /**
     * Controls whether segment outlines are displayed.
     */
    public function showOutlines(bool $show = true): self
    {
        return $this->set('showOutlines', $show);
    }

    /**
     * Sub-label text displayed in the gauge.
     */
    public function subLabel(string $subLabel): self
    {
        return $this->set('subLabel', $subLabel);
    }

    /**
     * Format string for the value.
     */
    public function valueFormat(string $format): self
    {
        return $this->set('valueFormat', $format);
    }

    public function getType(): string
    {
        return 'Chart.Gauge';
    }
}
