<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\FontType;
use AdaptiveCards\Enum\TextBlockStyle;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * A block of text, optionally formatted using Markdown.
 */
final class TextBlock extends AbstractBlockElement
{
    use HasHorizontalAlignment, HasSpacing;

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
     * The text to display. A subset of markdown is supported.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Defines an expression whose evaluated value will be used to update the
     * `text` property of the TextBlock at runtime.
     */
    public function textDynamic(string $expression): self
    {
        return $this->set('text.dynamic', $expression);
    }

    /**
     * The size of the text.
     * Valid values: "Small", "Default", "Medium", "Large", "ExtraLarge".
     */
    public function size(TextSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The weight of the text.
     * Valid values: "Lighter", "Default", "Bolder".
     */
    public function weight(TextWeight $weight): self
    {
        return $this->set('weight', $weight->value);
    }

    /**
     * The color of the text.
     * Valid values: "Default", "Dark", "Light", "Accent", "Good", "Warning", "Attention".
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * The type of font to use for rendering.
     * Valid values: "Default", "Monospace".
     */
    public function fontType(FontType $fontType): self
    {
        return $this->set('fontType', $fontType->value);
    }

    /**
     * Controls whether the text should be renderer using a subtler variant of the select color.
     */
    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    /**
     * The maximum number of lines to display.
     */
    public function maxLines(int $maxLines): self
    {
        return $this->set('maxLines', $maxLines);
    }

    /**
     * Controls if the text should wrap.
     */
    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    /**
     * The style of the text.
     * Valid values: "default", "columnHeader", "heading".
     */
    public function style(TextBlockStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * The Id of the input the TextBlock should act as the label of.
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
