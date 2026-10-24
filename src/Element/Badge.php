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
        string $title,
        string|BadgeSize|null $size = null,
        string|BadgeStyle|null $style = null,
    ) {
        $this->title($title);
        if ($size !== null) {
            $this->size($size);
        }
        if ($style !== null) {
            $this->style($style);
        }
    }

    public static function make(
        string $title,
        string|BadgeSize|null $size = null,
        string|BadgeStyle|null $style = null,
    ): self {
        return new self($title, $size, $style);
    }

    /**
     * The text to display.
     */
    public function title(string $title): self
    {
        return $this->text($title);
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
    public function size(string|BadgeSize $size): self
    {
        return $this->set('size', BadgeSize::value($size));
    }

    /**
     * Controls the shape of the badge.
     * Valid values: "Square", "Rounded", "Circular".
     */
    public function shape(string|BadgeShape $shape): self
    {
        return $this->set('shape', BadgeShape::value($shape));
    }

    /**
     * The style of the badge.
     * Valid values: "Default", "Subtle", "Informative", "Accent", "Good", "Attention", "Warning".
     */
    public function style(string|BadgeStyle $style): self
    {
        return $this->set('style', BadgeStyle::value($style));
    }

    /**
     * Controls the strength of the background color.
     * Valid values: "Filled", "Tint".
     */
    public function appearance(string|BadgeAppearance $appearance): self
    {
        return $this->set('appearance', BadgeAppearance::value($appearance));
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
    public function iconPosition(string|IconPosition $iconPosition): self
    {
        return $this->set('iconPosition', IconPosition::value($iconPosition));
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
