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
     * The maximum rating value.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * Controls the size of the rating stars.
     * Valid values: "small", "medium", "large".
     */
    public function size(string|RatingSize $size): self
    {
        return $this->set('size', RatingSize::value($size));
    }

    /**
     * Controls the color of the rating stars.
     * Valid values: "neutral", "marigold".
     */
    public function color(string|RatingColor $color): self
    {
        return $this->set('color', RatingColor::value($color));
    }

    /**
     * Controls whether the user can rate in half steps.
     */
    public function allowHalfSteps(bool $allow = true): self
    {
        return $this->set('allowHalfSteps', $allow);
    }

    /**
     * The number of ratings submitted.
     */
    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    public function getType(): string
    {
        return 'Input.Rating';
    }
}
