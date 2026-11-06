<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Defines an area in a Layout.AreaGrid layout.
 */
final class GridArea extends Node
{
    use HasKey;

    public function __construct(?string $name = null)
    {
        if ($name !== null) {
            $this->name($name);
        }
    }

    public static function make(?string $name = null): self
    {
        return new self($name);
    }

    /**
     * The name of the area. To place an element in this area, set its grid.area property to match the name of the area.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The start column index of the area. Column indices start at 1.
     */
    public function column(int $column): self
    {
        return $this->set('column', $column);
    }

    /**
     * The start row index of the area. Row indices start at 1.
     */
    public function row(int $row): self
    {
        return $this->set('row', $row);
    }

    /**
     * Defines how many columns the area should span.
     */
    public function columnSpan(int $columnSpan): self
    {
        return $this->set('columnSpan', $columnSpan);
    }

    /**
     * Defines how many rows the area should span.
     */
    public function rowSpan(int $rowSpan): self
    {
        return $this->set('rowSpan', $rowSpan);
    }

    public function getType(): ?string
    {
        return null;
    }
}
