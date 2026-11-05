<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Chart\AbstractChart;
use AdaptiveCards\Enum\GaugeValueFormat;

/**
 * A gauge chart.
 */
final class GaugeChart extends AbstractChart
{
    /**
     * @param iterable<GaugeChartLegend>|null $segments
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
     * @param iterable<GaugeChartLegend>|null $segments
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
     * The value of the gauge.
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
     *
     * @param GaugeChartLegend|iterable<GaugeChartLegend> $segment
     */
    public function addSegments(GaugeChartLegend|iterable $segment): self
    {
        if (is_iterable($segment)) {
            foreach ($segment as $item) {
                $this->push('segments', $item);
            }

            return $this;
        }

        return $this->push('segments', $segment);
    }

    /**
     * Add a legend to the gauge chart.
     *
     * @param GaugeChartLegend|iterable<GaugeChartLegend> $legend
     */
    public function addLegends(GaugeChartLegend|iterable $legend): self
    {
        return $this->addSegments($legend);
    }

    /**
     * The segments to display in the gauge.
     * Valid values: "GaugeChartLegend".
     *
     * @param iterable<GaugeChartLegend> $segments
     */
    public function segments(iterable $segments): self
    {
        return $this->addSegments($segments);
    }

    /**
     * Controls whether the min/max values should be displayed.
     */
    public function showMinMax(bool $show = true): self
    {
        return $this->set('showMinMax', $show);
    }

    /**
     * Controls whether the gauge's needle is displayed. Default is true.
     */
    public function showNeedle(bool $show = true): self
    {
        return $this->set('showNeedle', $show);
    }

    /**
     * Controls whether the outlines of the gauge segments are displayed.
     */
    public function showOutlines(bool $show = true): self
    {
        return $this->set('showOutlines', $show);
    }

    /**
     * The sub-label of the gauge.
     */
    public function subLabel(string $subLabel): self
    {
        return $this->set('subLabel', $subLabel);
    }

    /**
     * The format used to display the gauge's value.
     * Valid values: "Percentage", "Fraction".
     */
    public function valueFormat(GaugeValueFormat $format): self
    {
        return $this->set('valueFormat', $format->value);
    }

    public function getType(): string
    {
        return 'Chart.Gauge';
    }
}
