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
 * A block of text, optionally formatted using Markdown.
 */
final class TextBlock extends AbstractElement
{
    public function __construct(?string $text = null, ?bool $wrap = null)
    {
        if ($text !== null) {
            $this->text($text);
        }
        if ($wrap !== null) {
            $this->wrap($wrap);
        }
    }

    public static function make(?string $text = null, ?bool $wrap = null): self
    {
        return new self($text, $wrap);
    }

    /**
     * The text to display. A subset of Markdown is supported (bold, italics,
     * bullet lists, ordered lists, inline hyperlinks). In addition, TextBlock
     * supports in-string date/time formatting.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Defines an expression whose evaluated value will be used to update the
     * `text` property of the element at runtime.
     */
    public function textDynamic(string $expression): self
    {
        return $this->set('text.dynamic', $expression);
    }

    /**
     * Controls size of text.
     * Valid values: "small", "default", "medium", "large", "extraLarge".
     */
    public function size(string|TextSize $size): self
    {
        return $this->set('size', TextSize::value($size));
    }

    /**
     * Controls the weight of TextBlock elements.
     * Valid values: "default", "lighter", "bolder".
     */
    public function weight(string|TextWeight $weight): self
    {
        return $this->set('weight', TextWeight::value($weight));
    }

    /**
     * Controls the color of TextBlock elements.
     * Valid values: "default", "dark", "light", "accent", "good", "warning", "attention".
     */
    public function color(string|Colors $color): self
    {
        return $this->set('color', Colors::value($color));
    }

    /**
     * Type of font to use for rendering.
     * Valid values: "default", "monospace".
     */
    public function fontType(string|FontType $fontType): self
    {
        return $this->set('fontType', FontType::value($fontType));
    }

    /**
     * If true, displays text slightly toned down to appear less prominent.
     */
    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    /**
     * Specifies the maximum number of lines to display.
     */
    public function maxLines(int $maxLines): self
    {
        return $this->set('maxLines', $maxLines);
    }

    /**
     * If true, allow text to wrap. Otherwise, text is clipped.
     */
    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    /**
     * The style of this TextBlock.
     * Valid values: "default", "heading".
     */
    public function style(string|TextBlockStyle $style): self
    {
        return $this->set('style', TextBlockStyle::value($style));
    }

    /**
     * A string identifier representing the input element that this text block provides
     * a label for. When a screen reader focuses on the input element, it announces this
     * text block as the input's label.
     */
    public function labelFor(string $inputId): self
    {
        return $this->set('labelFor', $inputId);
    }

    public function getType(): string
    {
        return 'TextBlock';
    }
}
