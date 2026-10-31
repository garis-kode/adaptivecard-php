<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Enum\ChartThickness;

/**
 * A pie chart.
 */
final class PieChart extends AbstractChart
{
    /**
     * @param iterable<DonutChartData>|null $data
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
     * @param iterable<DonutChartData>|null $data
     */
    public static function make(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
    ): self {
        return new self($title, $showTitle, $data);
    }

    /**
     * Add data to the pie chart (accepts a single item or an iterable of items).
     *
     * @param DonutChartData|iterable<DonutChartData> $data
     */
    public function addData(DonutChartData|iterable $data): self
    {
        if (is_iterable($data)) {
            foreach ($data as $item) {
                $this->push('data', $item);
            }

            return $this;
        }

        return $this->push('data', $data);
    }

    /**
     * Add multiple data items to the pie chart.
     *
     * @param iterable<DonutChartData> $data
     */
    public function addDataList(iterable $data): self
    {
        return $this->addData($data);
    }

    /**
     * The data to display in the chart.
     * Valid values: "DonutChartData".
     *
     * @param iterable<DonutChartData> $data
     */
    public function data(iterable $data): self
    {
        return $this->addData($data);
    }

    /**
     * Controls whether the outlines of the donut segments are displayed.
     */
    public function showOutlines(bool $show = true): self
    {
        return $this->set('showOutlines', $show);
    }

    /**
     * Controls the thickness of the donut segments. Default is Thick.
     * Valid values: "Thin", "Thick".
     */
    public function thickness(ChartThickness $thickness): self
    {
        return $this->set('thickness', $thickness->value);
    }

    /**
     * The value that should be displayed in the center of a Donut chart. `value` is ignored for Pie charts.
     */
    public function value(string|int|float $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * Controls the color of the value displayed in the center of a Donut chart. 
     * Valid values: "good", "warning", "attention", "neutral", "categoricalRed", "categoricalPurple",
     * "categoricalLavender", "categoricalBlue", "categoricalLightBlue", "categoricalTeal",
     * "categoricalGreen", "categoricalLime", "categoricalMarigold", "sequential1", "sequential2",
     * "sequential3", "sequential4", "sequential5", "sequential6", "sequential7", "sequential8",
     * "divergingBlue", "divergingLightBlue", "divergingCyan", "divergingTeal", "divergingYellow",
     * "divergingPeach", "divergingLightRed", "divergingRed", "divergingMaroon", "divergingGray",
     * "sequentialRed1", "sequentialRed2", "sequentialRed3", "sequentialRed4", "sequentialRed5",
     * "sequentialRed6", "sequentialRed7", "sequentialRed8", "sequentialGreen1", "sequentialGreen2",
     * "sequentialGreen3", "sequentialGreen4", "sequentialGreen5", "sequentialGreen6",
     * "sequentialGreen7", "sequentialGreen8", "sequentialYellow1", "sequentialYellow2",
     * "sequentialYellow3", "sequentialYellow4", "sequentialYellow5", "sequentialYellow6",
     * "sequentialYellow7", "sequentialYellow8".
     */
    public function valueColor(ChartColor $color): self
    {
        return $this->set('valueColor', $color->value);
    }

    public function getType(): string
    {
        return 'Chart.Pie';
    }
}

