<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\RatingStyle;
use AdaptiveCards\Support\HasHorizontalAlignment;

/**
 * A read-only star rating element, to display the rating of something.
 */
final class Rating extends AbstractBlockElement
{
    use HasHorizontalAlignment;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The value of the rating. Must be between 0 and `max`.
     */
    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The number of stars to display.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * The number of "votes" associated with the rating.
     */
    public function count(int $count): self
    {
        return $this->set('count', $count);
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
     * The style of the stars.
     * Valid values: "Default", "Compact".
     */
    public function style(RatingStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    public function getType(): string
    {
        return 'Rating';
    }
}
