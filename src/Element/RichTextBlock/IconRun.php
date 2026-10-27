<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Enum\TextSize;

/**
 * An inline icon inside a RichTextBlock element.
 */
final class IconRun extends AbstractElement
{
    public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): self
    {
        return new self($name);
    }

    /**
     * The name of the inline icon to display.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The color of the inline icon.
     * Valid values: "Default", "Dark", "Light", "Accent", "Good", "Warning", "Attention".
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * The size of the inline icon.
     * Valid values: "Small", "Default", "Medium", "Large", "ExtraLarge".
     */
    public function size(TextSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The style of the inline icon.
     * Valid values: "Regular", "Filled".
     */
    public function style(IconStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * An Action that will be invoked when the inline icon is tapped or clicked.
     * Action.ShowCard is not supported.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'IconRun';
    }
}
