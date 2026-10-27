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
    public function __construct(
        ?string $text = null,
        ?BadgeSize $size = null,
        ?BadgeStyle $style = null,
    ) {
        if ($text !== null) {
            $this->text($text);
        }
        if ($size !== null) {
            $this->size($size);
        }
        if ($style !== null) {
            $this->style($style);
        }
    }

    public static function make(
        ?string $text = null,
        ?BadgeSize $size = null,
        ?BadgeStyle $style = null,
    ): self {
        return new self($text, $size, $style);
    }

    /**
     * The text to display.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * The size of the badge.
     * Valid values: "Medium", "Large", "ExtraLarge".
     */
    public function size(BadgeSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * Controls the shape of the badge.
     * Valid values: "Square", "Rounded", "Circular".
     */
    public function shape(BadgeShape $shape): self
    {
        return $this->set('shape', $shape->value);
    }

    /**
     * The style of the badge.
     * Valid values: "Default", "Subtle", "Informative", "Accent", "Good", "Attention", "Warning".
     */
    public function style(BadgeStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls the strength of the background color.
     * Valid values: "Filled", "Tint".
     */
    public function appearance(BadgeAppearance $appearance): self
    {
        return $this->set('appearance', $appearance->value);
    }

    /**
     * The name of an icon from the Adaptive Card icon catalog to display,
     * in the `<icon-name>[,regular|filled]` format. If the style is not specified,
     * the regular style is used.
     */
    public function icon(string $icon): self
    {
        return $this->set('icon', $icon);
    }

    /**
     * Controls the position of the icon.
     * Valid values: "Before", "After".
     */
    public function iconPosition(IconPosition $iconPosition): self
    {
        return $this->set('iconPosition', $iconPosition->value);
    }

    /**
     * Controls the tooltip text to display when the badge is hovered over.
     */
    public function tooltip(string $tooltip): self
    {
        return $this->set('tooltip', $tooltip);
    }

    public function getType(): string
    {
        return 'Badge';
    }
}
