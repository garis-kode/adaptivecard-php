<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\RatingStyle;

/**
 * A read-only star rating element, to display the rating of something.
 */
final class Rating extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The rating value.
     */
    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The maximum rating value.
     */
    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    /**
     * The number of ratings submitted.
     */
    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    /**
     * Controls the size of the rating stars.
     * Valid values: "Medium", "Large".
     */
    public function size(RatingSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * Controls the color of the rating stars.
     * Valid values: "Neutral", "Marigold".
     */
    public function color(RatingColor $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Controls the style of the rating stars.
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
