<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\FontType;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\TextBlockStyle;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;

/**
 * Displays text, optionally with styling and wrapping.
 */
final class TextBlock extends AbstractElement
{
    public function __construct(string $text)
    {
        $this->set('text', $text);
    }

    public static function make(string $text): self
    {
        return new self($text);
    }

    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    public function size(string|TextSize $size): self
    {
        return $this->set('size', TextSize::value($size));
    }

    public function weight(string|TextWeight $weight): self
    {
        return $this->set('weight', TextWeight::value($weight));
    }

    public function color(string|Colors $color): self
    {
        return $this->set('color', Colors::value($color));
    }

    public function fontType(string|FontType $fontType): self
    {
        return $this->set('fontType', FontType::value($fontType));
    }


    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    public function maxLines(int $maxLines): self
    {
        return $this->set('maxLines', $maxLines);
    }

    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    public function style(string|TextBlockStyle $style): self
    {
        return $this->set('style', TextBlockStyle::value($style));
    }

    public function labelFor(string $inputId): self
    {
        return $this->set('labelFor', $inputId);
    }

    public function getType(): string
    {
        return 'TextBlock';
    }
}
