<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ProgressRingSize;

/**
 * A spinning ring element, to indicate progress.
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

    /**
     * The label to display alongside the progress ring.
     */
    public function label(string $label): self
    {
        return $this->set('label', $label);
    }

    /**
     * Specifies the position of the label relative to the progress ring.
     * Valid values: "Before", "After", "Above", "Below".
     *
     * @param "Before"|"After"|"Above"|"Below"|string $labelPosition
     */
    public function labelPosition(string $labelPosition): self
    {
        return $this->set('labelPosition', $labelPosition);
    }

    /**
     * Controls the size of the progress ring.
     * Valid values: "Small", "Medium", "Large", "ExtraLarge".
     */
    public function size(string|ProgressRingSize $size): self
    {
        return $this->set('size', ProgressRingSize::value($size));
    }

    public function getType(): string
    {
        return 'ProgressRing';
    }
}
