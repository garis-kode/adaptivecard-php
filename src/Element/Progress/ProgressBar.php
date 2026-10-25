<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractElement;

/**
 * A progress bar element, to represent a value within a range.
 */
final class ProgressBar extends AbstractElement
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    /**
     * The current value of the progress bar.
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
     * Controls the color of the progress bar.
     * Valid values: "Accent", "Good", "Warning", "Attention".
     *
     * @param "Accent"|"Good"|"Warning"|"Attention"|string $color
     */
    public function color(string $color): self
    {
        return $this->set('color', $color);
    }

    public function getType(): string
    {
        return 'ProgressBar';
    }
}
