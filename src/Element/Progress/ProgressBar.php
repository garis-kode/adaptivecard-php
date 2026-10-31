<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ProgressBarColor;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * A progress bar element, to represent a value within a range.
 */
final class ProgressBar extends AbstractBlockElement
{
    use HasHeight, HasHorizontalAlignment, HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The value of the progress bar. Must be between 0 and `max`.
     */
    public function value(float|int|null $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The maximum value of the progress bar.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * The color of the progress bar. `color` has no effect when the `ProgressBar` is in
     * indeterminate mode, in which case the "accent" color is always used.
     * Valid values: "Accent", "Good", "Warning", "Attention".
     */
    public function color(ProgressBarColor $color): self
    {
        return $this->set('color', $color->value);
    }

    public function getType(): string
    {
        return 'ProgressBar';
    }
}
