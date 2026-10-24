<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractElement;

/**
 * A progress bar element displaying progress towards an activity completion.
 */
final class ProgressBar extends AbstractElement
{
    public function __construct(float|int|null $value = null, float|int $max = 100)
    {
        $this->set('value', $value);
        if ($max !== 100) {
            $this->set('max', $max);
        }
    }

    public static function make(float|int|null $value = null, float|int $max = 100): self
    {
        return new self($value, $max);
    }

    public function value(float|int|null $value): self
    {
        return $this->set('value', $value);
    }

    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
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
