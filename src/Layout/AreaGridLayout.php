<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

use AdaptiveCards\Enum\Spacing;

/**
 * Area grid layout: positions elements in named grid areas.
 */
final class AreaGridLayout extends AbstractLayout
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a column definition to the area grid layout. Columns can be defined
     * as a percentage of the available width (number) or in pixels ("<number>px").
     *
     * @param int|float|string|iterable<int|float|string> $column
     */
    public function addColumns(int|float|string|iterable $column): self
    {
        if (is_iterable($column)) {
            foreach ($column as $item) {
                $this->push('columns', $item);
            }

            return $this;
        }

        return $this->push('columns', $column);
    }

    /**
     * The columns in the grid layout, defined as a percentage of the available
     * width or in pixels using the `<number>px` format.
     *
     * @param iterable<int|float|string> $columns
     */
    public function columns(iterable $columns): self
    {
        return $this->addColumns($columns);
    }

    /**
     * Add an area definition to the grid layout.
     *
     * @param GridArea|iterable<GridArea> $area
     */
    public function addAreas(GridArea|iterable $area): self
    {
        if (is_iterable($area)) {
            foreach ($area as $item) {
                $this->push('areas', $item);
            }

            return $this;
        }

        return $this->push('areas', $area);
    }

    /**
     * The areas in the grid layout mapping named areas to rows and columns.
     * Valid values: "GridArea".
     *
     * @param iterable<GridArea> $areas
     */
    public function areas(iterable $areas): self
    {
        return $this->addAreas($areas);
    }

    /**
     * The space between columns.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function columnSpacing(Spacing $spacing): self
    {
        return $this->set('columnSpacing', $spacing->value);
    }

    /**
     * The space between rows.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function rowSpacing(Spacing $spacing): self
    {
        return $this->set('rowSpacing', $spacing->value);
    }

    public function getType(): string
    {
        return 'Layout.AreaGrid';
    }
}
