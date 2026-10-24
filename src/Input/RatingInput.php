<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;

/**
 * An interactive rating input element.
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

    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    public function size(string|RatingSize $size): self
    {
        return $this->set('size', RatingSize::value($size));
    }

    public function color(string|RatingColor $color): self
    {
        return $this->set('color', RatingColor::value($color));
    }

    public function allowHalfSteps(bool $allow = true): self
    {
        return $this->set('allowHalfSteps', $allow);
    }

    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    public function getType(): string
    {
        return 'Input.Rating';
    }
}
