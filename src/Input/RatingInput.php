<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;

/**
 * An input to allow the user to rate something using stars.
 */
final class RatingInput extends AbstractInput
{
    public function __construct(string $id, ?string $label = null)
    {
        parent::__construct($id);
        if ($label !== null) {
            $this->label($label);
        }
    }

    public static function make(string $id, ?string $label = null): self
    {
        return new self($id, $label);
    }

    /**
     * The number of stars to display.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * The size of the stars.
     * Valid values: "Medium", "Large".
     */
    public function size(RatingSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The color of the stars.
     * Valid values: "Neutral", "Marigold".
     */
    public function color(RatingColor $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Controls if the user can select half stars.
     */
    public function allowHalfSteps(bool $allow = true): self
    {
        return $this->set('allowHalfSteps', $allow);
    }

    public function getType(): string
    {
        return 'Input.Rating';
    }
}
