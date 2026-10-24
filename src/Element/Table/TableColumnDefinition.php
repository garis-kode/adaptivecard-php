<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Node;

/**
 * Defines the width and default cell alignment of a {@see Table} column.
 * Has no `type` field.
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

    public function width(string|int $width): self
    {
        return $this->set('width', $width);
    }

    public function horizontalCellContentAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', HorizontalAlignment::value($alignment));
    }

    public function verticalCellContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalCellContentAlignment', VerticalAlignment::value($alignment));
    }

    public function getType(): ?string
    {
        return null;
    }
}
