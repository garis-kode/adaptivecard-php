<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\RatingStyle;

/**
 * A rating element displaying a number of stars and optional rating count.
 */
final class Rating extends AbstractElement
{
    public function __construct(
        float|int|null $value = null,
        float|int $max = 5,
        ?int $count = null,
    ) {
        $this->set('value', $value);
        if ($max !== 5) {
            $this->set('max', $max);
        }
        $this->set('count', $count);
    }

    public static function make(
        float|int|null $value = null,
        float|int $max = 5,
        ?int $count = null,
    ): self {
        return new self($value, $max, $count);
    }

    public function value(float|int $value): self
    {
        return $this->set('value', $value);
    }

    public function max(float|int $max): self
    {
        return $this->set('max', $max);
    }

    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    public function size(string|RatingSize $size): self
    {
        return $this->set('size', RatingSize::value($size));
    }

    public function color(string|RatingColor $color): self
    {
        return $this->set('color', RatingColor::value($color));
    }

    public function style(string|RatingStyle $style): self
    {
        return $this->set('style', RatingStyle::value($style));
    }

    public function getType(): string
    {
        return 'Rating';
    }
}
