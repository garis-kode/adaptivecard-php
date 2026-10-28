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
     * The text to display. A subset of markdown is supported.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Defines an expression whose evaluated value will be used to update the `text` property of the
     * TextBlock at runtime.
     */
    public function textDynamic(string $expression): self
    {
        return $this->set('text.dynamic', $expression);
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
     * Controls whether the text should be renderer using a subtler variant of the select color.
     */
    public function isSubtle(bool $subtle = true): self
    {
        return $this->set('isSubtle', $subtle);
    }

    /**
     * Controls if the text should be italicized.
     */
    public function italic(bool $italic = true): self
    {
        return $this->set('italic', $italic);
    }

    /**
     * Controls if the text should be struck through.
     */
    public function strikethrough(bool $strikethrough = true): self
    {
        return $this->set('strikethrough', $strikethrough);
    }

    /**
     * Controls if the text should be highlighted.
     */
    public function highlight(bool $highlight = true): self
    {
        return $this->set('highlight', $highlight);
    }

    /**
     * Controls if the text should be underlined.
     */
    public function underline(bool $underline = true): self
    {
        return $this->set('underline', $underline);
    }

    /**
     * An Action that will be invoked when the text is tapped or clicked.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
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
