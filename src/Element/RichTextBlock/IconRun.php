<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconStyle;

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
     * The name of an icon from the Adaptive Card icon catalog to display,
     * in the `<icon-name>[,regular|filled]` format.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * Controls the color of IconRun elements.
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * Controls the size of the icon.
     *
     * @param "Small"|"Default"|"Medium"|"Large"|"ExtraLarge"|string $size
     */
    public function size(string $size): self
    {
        return $this->set('size', $size);
    }

    /**
     * Controls the style of the icon.
     */
    public function style(IconStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * An Action that will be invoked when the icon is tapped or clicked.
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
