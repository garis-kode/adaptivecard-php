<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Node;

/**
 * Defines a column in a Table element.
 */
final class TableColumnDefinition extends Node
{
    public function __construct(Width|string|int|null $width = null)
    {
        if ($width !== null) {
            $this->width($width);
        }
    }

    public static function make(Width|string|int|null $width = null): self
    {
        return new self($width);
    }

    /**
     * The width of the column in the table. If expressed as a number, represents the relative
     * weight of the column in the table. If expressed as a string, `auto` will automatically
     * adjust the column's width according to its content and using the `<number>px` format will
     * give the column an explicit width in pixels.
     * Valid values: "auto", "<number>px".
     */
    public function width(Width|string|int $width): self
    {
        $value = $width instanceof Width ? $width->value : $width;

        return $this->set('width', $value);
    }

    /**
     * Controls how the content of every cell in the table should be horizontally aligned by default.
     * This property overrides the `horizontalCellContentAlignment` property of the table.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how the content of every cell in the column should be vertically aligned by default.
     * This property overrides the `verticalCellContentAlignment` property of the table.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalCellContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalCellContentAlignment', $alignment->value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
