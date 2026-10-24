<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\FontType;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;

/**
 * A styled run of text inside a {@see RichTextBlock}.
 */
final class TextRun extends AbstractElement
{
    public function __construct(string $text)
    {
        $this->text($text);
    }

    public static function make(string $text): self
    {
        return new self($text);
    }

    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    public function textDynamic(string $expression): self
    {
        return $this->set('text.dynamic', $expression);
    }

    public function color(string|Colors $color): self
    {
        return $this->set('color', Colors::value($color));
    }

    public function fontType(string|FontType $fontType): self
    {
        return $this->set('fontType', FontType::value($fontType));
    }

    public function size(string|TextSize $size): self
    {
        return $this->set('size', TextSize::value($size));
    }

    public function weight(string|TextWeight $weight): self
    {
        return $this->set('weight', TextWeight::value($weight));
    }

    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    public function italic(bool $italic = true): self
    {
        return $this->set('italic', $italic);
    }

    public function strikethrough(bool $strikethrough = true): self
    {
        return $this->set('strikethrough', $strikethrough);
    }

    public function highlight(bool $highlight = true): self
    {
        return $this->set('highlight', $highlight);
    }

    public function underline(bool $underline = true): self
    {
        return $this->set('underline', $underline);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'TextRun';
    }
}
