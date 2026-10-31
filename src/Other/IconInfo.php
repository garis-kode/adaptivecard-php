<?php

declare(strict_types=1);

namespace AdaptiveCards\Other;

use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Node;

/**
 * Defines information about a Fluent icon and how it should be rendered.
 */
final class IconInfo extends Node
{
    public function __construct(
        ?string $name = null,
        ?Colors $color = null,
        ?IconSize $size = null,
        ?IconStyle $style = null,
    ) {
        if ($name !== null) {
            $this->name($name);
        }
        if ($color !== null) {
            $this->color($color);
        }
        if ($size !== null) {
            $this->size($size);
        }
        if ($style !== null) {
            $this->style($style);
        }
    }

    public static function make(
        ?string $name = null,
        ?Colors $color = null,
        ?IconSize $size = null,
        ?IconStyle $style = null,
    ): self {
        return new self($name, $color, $size, $style);
    }

    /**
     * The color of the icon.
     * Valid values: "Default", "Dark", "Light", "Accent", "Good", "Warning", "Attention".
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * The name of the icon to display.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The size of the icon.
     * Valid values: "xxSmall", "xSmall", "Small", "Standard", "Medium", "Large", "xLarge", "xxLarge".
     */
    public function size(IconSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The style of the icon.
     * Valid values: "Regular", "Filled".
     */
    public function style(IconStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
