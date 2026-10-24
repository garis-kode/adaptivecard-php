<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ProgressRingSize;

/**
 * An indeterminate rotating circular indicator that a background process is running.
 */
final class ProgressRing extends AbstractElement
{
    public function __construct(?string $label = null)
    {
        if ($label !== null) {
            $this->label($label);
        }
    }

    public static function make(?string $label = null): self
    {
        return new self($label);
    }

    public function label(string $label): self
    {
        return $this->set('label', $label);
    }

    /**
     * @param "Before"|"After"|"Above"|"Below"|string $labelPosition
     */
    public function labelPosition(string $labelPosition): self
    {
        return $this->set('labelPosition', $labelPosition);
    }

    public function size(string|ProgressRingSize $size): self
    {
        return $this->set('size', ProgressRingSize::value($size));
    }

    public function getType(): string
    {
        return 'ProgressRing';
    }
}
