<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Node;

/**
 * Defines a column in a Table element.
 */
final class TableColumnDefinition extends Node
{
    /**
     * @param string|int|null $width A relative weight (e.g. 1) or pixels ("80px").
     */
    public function __construct(string|int|null $width = null)
    {
        if ($width !== null) {
            $this->width($width);
        }
    }

    public static function make(string|int|null $width = null): self
    {
        return new self($width);
    }

    /**
     * Specifies the width of the column. When set to a number, the column is
     * weighted relative to other columns. Pixel width can also be specified, e.g. "80px".
     */
    public function width(string|int $width): self
    {
        return $this->set('width', $width);
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
