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
    public function __construct(Width|int|null $width = null)
    {
        if ($width !== null) {
            $this->width($width);
        }
    }

    public static function make(Width|int|null $width = null): self
    {
        return new self($width);
    }

    /**
     * Specifies the width of the column. Width::Auto or relative weight (e.g. 1).
     */
    public function width(Width|int $width): self
    {
        $value = $width instanceof Width ? $width->value : $width;

        return $this->set('width', $value);
    }

    /**
     * Explicit pixel width for the column, in pixels.
     */
    public function pixelWidth(int $pixels): self
    {
        return $this->set('width', "{$pixels}px");
    }

    /**
     * Controls how cells should be horizontally aligned in this column.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how cells should be vertically aligned in this column.
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
