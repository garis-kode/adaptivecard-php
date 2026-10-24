<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;

/**
 * A standalone icon element. Icons can be picked from the vast Adaptive Card icon catalog.
 */
final class Icon extends AbstractElement
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
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
     * Controls the color of Icon elements.
     * Valid values: "default", "dark", "light", "accent", "good", "warning", "attention".
     */
    public function color(string|Colors $color): self
    {
        return $this->set('color', Colors::value($color));
    }

    /**
     * Controls the size of the icon.
     * Valid values: "xxSmall", "xSmall", "small", "standard", "medium", "large", "xLarge", "xxLarge".
     */
    public function size(string|IconSize $size): self
    {
        return $this->set('size', IconSize::value($size));
    }

    /**
     * Controls the style of the icon.
     * Valid values: "regular", "filled".
     */
    public function style(string|IconStyle $style): self
    {
        return $this->set('style', IconStyle::value($style));
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
        return 'Icon';
    }
}
