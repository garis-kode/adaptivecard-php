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
 * A block of text inside a RichTextBlock element.
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

    /**
     * The text to display.
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
     * Controls the color of TextRun elements.
     * Valid values: "Default", "Dark", "Light", "Accent", "Good", "Warning", "Attention".
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Type of font to use for rendering.
     * Valid values: "Default", "Monospace".
     */
    public function fontType(FontType $fontType): self
    {
        return $this->set('fontType', $fontType->value);
    }

    /**
     * Controls size of text.
     * Valid values: "Default", "Small", "Medium", "Large", "ExtraLarge".
     */
    public function size(TextSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * Controls the weight of TextRun elements.
     * Valid values: "Default", "Lighter", "Bolder".
     */
    public function weight(TextWeight $weight): self
    {
        return $this->set('weight', $weight->value);
    }

    /**
     * If true, displays text slightly toned down to appear less prominent.
     */
    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    /**
     * If true, displays the text in an italic font.
     */
    public function italic(bool $italic = true): self
    {
        return $this->set('italic', $italic);
    }

    /**
     * If true, displays the text with a strikethrough.
     */
    public function strikethrough(bool $strikethrough = true): self
    {
        return $this->set('strikethrough', $strikethrough);
    }

    /**
     * If true, displays the text highlighted.
     */
    public function highlight(bool $highlight = true): self
    {
        return $this->set('highlight', $highlight);
    }

    /**
     * If true, displays the text with an underline.
     */
    public function underline(bool $underline = true): self
    {
        return $this->set('underline', $underline);
    }

    /**
     * An Action that will be invoked when the TextRun is clicked or tapped.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'TextRun';
    }
}
