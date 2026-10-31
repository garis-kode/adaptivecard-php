<?php

declare(strict_types=1);

namespace AdaptiveCards\Chart\Gauge;

use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Node;

/**
 * The legend of the chart.
 */
final class GaugeSegment extends Node
{
    public function __construct(string $legend, float|int $size, ?ChartColor $color = null)
    {
        $this->legend($legend);
        $this->size($size);
       
        if ($color !== null) {
            $this->color($color);
        }
    }

    public static function make(string $legend, float|int $size, ?ChartColor $color = null): self
    {
        return new self($legend, $size, $color);
    }

    /**
     * The legend text associated with the segment.
     */
    public function legend(string $legend): self
    {
        return $this->set('legend', $legend);
    }

    /**
     * The size of the segment.
     */
    public function size(float|int $size): self
    {
        return $this->set('size', $size);
    }

    /**
     * The color to use for the segment.
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
    public function color(ChartColor $color): self
    {
        return $this->set('color', $color->value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
