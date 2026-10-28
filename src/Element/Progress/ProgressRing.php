<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Progress;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ProgressRingLabelPosition;
use AdaptiveCards\Enum\ProgressRingSize;

/**
 * A spinning ring element, to indicate progress.
 */
final class ProgressRing extends AbstractBlockElement
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
     * The label of the progress ring.
     */
    public function label(string $label): self
    {
        return $this->set('label', $label);
    }

    /**
     * Controls the relative position of the label to the progress ring.
     * Valid values: "Before", "After", "Above", "Below".
     */
    public function labelPosition(ProgressRingLabelPosition $position): self
    {
        return $this->set('labelPosition', $position->value);
    }

    /**
     * The size of the progress ring.
     * Valid values: "Tiny", "Small", "Medium", "Large".
     */
    public function size(ProgressRingSize $size): self
    {
        return $this->set('size', $size->value);
    }

    public function getType(): string
    {
        return 'ProgressRing';
    }
}
