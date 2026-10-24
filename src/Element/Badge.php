<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\BadgeAppearance;
use AdaptiveCards\Enum\BadgeShape;
use AdaptiveCards\Enum\BadgeSize;
use AdaptiveCards\Enum\BadgeStyle;
use AdaptiveCards\Enum\IconPosition;

/**
 * A badge element to show an icon and/or text in a compact form over a colored background.
 */
final class Badge extends AbstractElement
{
    public function __construct(?string $text = null)
    {
        $this->set('text', $text);
    }

    public static function make(?string $text = null): self
    {
        return new self($text);
    }

    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    public function size(string|BadgeSize $size): self
    {
        return $this->set('size', BadgeSize::value($size));
    }

    public function shape(string|BadgeShape $shape): self
    {
        return $this->set('shape', BadgeShape::value($shape));
    }

    public function style(string|BadgeStyle $style): self
    {
        return $this->set('style', BadgeStyle::value($style));
    }

    public function appearance(string|BadgeAppearance $appearance): self
    {
        return $this->set('appearance', BadgeAppearance::value($appearance));
    }

    public function icon(string $icon): self
    {
        return $this->set('icon', $icon);
    }

    public function iconPosition(string|IconPosition $iconPosition): self
    {
        return $this->set('iconPosition', IconPosition::value($iconPosition));
    }

    public function tooltip(string $tooltip): self
    {
        return $this->set('tooltip', $tooltip);
    }

    public function getType(): string
    {
        return 'Badge';
    }
}
